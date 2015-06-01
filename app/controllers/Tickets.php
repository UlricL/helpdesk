<?php
/**
 * Gestion des tickets
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Tickets extends \_DefaultController
{
	public function Tickets()
	{
		parent::__construct();
		$this->title = "Tickets";
		$this->model = "Ticket";
	}

	public function messages($id)
	{
		$ticket = DAO::getOne("Ticket", $id[0]);
		if ($ticket != NULL) {
			echo "<h2>" . $ticket . "</h2>";
			$messages = DAO::getOneToMany($ticket, "messages");
			echo "<table class='table table-striped'>";
			echo "<thead><tr><th>Messages</th></tr></thead>";
			echo "<tbody>";
			foreach ($messages as $msg) {
				echo "<tr>";
				echo "<td title='message' data-content='" . htmlentities($msg->getContenu()) . "' data-container='body' data-toggle='popover' data-placement='bottom'>" . $msg->toString() . "</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo JsUtils::execute("$(function () {
					  $('[data-toggle=\"popover\"]').popover({'trigger':'hover','html':true})
				})");
		}
	}

	public function frm($id = null)
	{
		if (Auth::isAuth()) {
			$ticket = $this->getInstance($id);
			$categories = DAO::getAll("Categorie");
			if ($ticket->getCategorie() == null) {
				$cat = -1;
			} else {
				$cat = $ticket->getCategorie()->getId();
			}
			$listCat = Gui::select($categories, $cat, "Sélectionnez une catégorie...");
			$listType = Gui::select(array("demande", "incident"), $ticket->getType(), "Sélectionner un type ...");
			$listStatut = Gui::select(DAO::getAll("Statut"), $ticket->getStatut(), "Sélectionnez le statut");

			$this->loadView("ticket/vAdd", array("ticket" => $ticket, "listCat" => $listCat, "listType" => $listType, "listStatut" => $listStatut));

			echo JsUtils::execute("CKEDITOR.replace('description');");
		} else {
			$this->nonValid();
		}
	}

	public function onInvalidControl()
	{
		$this->loadView("main/vHeader", array("infoUser" => Auth::getInfoUser()));
		$this->nonValid();
		$this->loadView("main/vFooter");
		exit;
	}

	private function nonValid()
	{
		echo "<div class='container'>";
		$this->messageDanger("Accès interdit. Vous devez vous connecter" . Auth::getInfoUser());
		echo "</div>";
	}


	protected function setValuesToObject(&$object)
	{
		parent::setValuesToObject($object);
		$object->setUser(Auth::getUser());
		$object->setUser(Auth::getUser());
		$categorie = DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
		if(empty($object->getStatut())) {
			$object->setStatut(DAO::getOne("Statut",1));
		}
	}
}
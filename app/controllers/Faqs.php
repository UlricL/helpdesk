<?php
/**
 * Gestion des articles de la Faq
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Faqs extends \_DefaultController {
	public function Faqs(){
		parent::__construct();
		$this->title="Foire aux questions";
		$this->model="Faq";
	}

	protected function setValuesToObject(&$object)
	{
		parent::setValuesToObject($object);
		$object->setUser(Auth::getUser());
		$categorie = DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
	}

	public function messages($id){
		$ticket=DAO::getOne("Ticket", $id[0]);
		if($ticket!=NULL){
			echo "<h2>".$ticket."</h2>";
			$messages=DAO::getOneToMany($ticket, "messages");
			echo "<table class='table table-striped'>";
			echo "<thead><tr><th>Messages</th></tr></thead>";
			echo "<tbody>";
			foreach ($messages as $msg){
				echo "<tr>";
				echo "<td title='message' data-content='".htmlentities($msg->getContenu())."' data-container='body' data-toggle='popover' data-placement='bottom'>".$msg->toString()."</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo JsUtils::execute("$(function () {
					  $('[data-toggle=\"popover\"]').popover({'trigger':'hover','html':true})
				})");
		}
	}

	public function frm($id=null){
		if(Auth::isAdmin()){
			$article = $this->getInstance($id);
			$categories = DAO::getAll("Categorie");
			$cat = -1;
			if ($article->getCategorie() != null) {
				$cat = $article->getCategorie()->getId();
			}
			$list = Gui::select($categories, $cat, "Sélectionnez une catégorie ...");
			$this->loadView("faq/vAdd", array("article" => $article, "listCat" => $list));
			echo JsUtils::execute("CKEDITOR.replace( 'contenu');");
		}else{
			$this->nonValid();
		}
	}

	public function isValid() {
		return Auth::isAuth();
	}

	public function onInvalidControl () {
		$this->loadView("main/vHeader", array("infoUser"=>Auth::getInfoUser()));
		$this->nonValid();
		$this->loadView("main/vFooter");
		exit;
	}

	private function nonValid(){
		echo "<div class='container'>";
		$this->messageDanger("Accès interdit. Vous devez vous connecter".Auth::getInfoUser());
		echo "</div>";
	}
}


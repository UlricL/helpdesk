<?php
/**
 * Gestion des tickets
 * @author jcheron
 * @version 1.1
 * @package helpdesk.controllers
 */
class Tickets extends \_DefaultController {
	public function Tickets(){
		parent::__construct();
		$this->title="Tickets";
		$this->model="Ticket";
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

	private static function getTypes(){
		return ["incident" => "Incident", "demande" => "Demande"];
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

			//$statuts = DAO::getAll("Statut");
			$ticket = DAO::getOne("Ticket", $id[0]);

			$this->loadView("ticket/vAdd", array(
				//"ticketTypes" => Tickets::getTypes(),
				//"categories" => $categories,
				"ticket" => $ticket,
				//"statut" => $statuts,
				"listCat" => $list,
				//"article" => $article
			));





			echo JsUtils::execute("CKEDITOR.replace('description');");
		}else{
			$this->nonValid();
		}
	}

	public function add($id=NULL) {
		if(Auth::isAuth()) {
			if(!empty($_POST['type']) && !empty($_POST['categorie']) && !empty($_POST['titre']) && !empty($_POST['description'])) {
				$ticket = new Ticket();
				$ticket->setUser(Auth::getUser());
				$ticket->setStatut(DAO::getOne("Statut",1));
				if(in_array($_POST['type'], Tickets::getTypes())) {
					$ticket->setType($_POST['type']);
				}
				$ticket->setCategorie(DAO::getOne("Categorie",$_POST['categorie']));
				$ticket->setTitre($_POST['titre']);
				$ticket->setDescription($_POST['description']);
				DAO::insert($ticket);
				$this->messageSuccess("Le nouveau ticket a bien été crée !");
			}
			else
				$this->messageWarning("Vous devez remplir tous les champs pour créer un ticket !");
		}
		else
			$this->messageDanger("Vous devez être connecté pour accéder à cette page.");
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


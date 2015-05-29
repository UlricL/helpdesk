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

	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */

	protected function setValuesToObject($object) { // modif set values to object
		parent::setValuesToObject($object);
		$object->setUser(Auth::getUser());
		$categorie=DAO::getOne("Categorie", $_POST["idCategorie"]);
		$object->setCategorie($categorie);
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


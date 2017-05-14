<?php
	//CLASSES CLIENT FACTURE
	
	class Client{
		
		private $_id;
		private $_nom;
		private $_prenom;
		private $_adresse;
		private $_cp;
		private $_ville;
		public 	$_facture;
		
		public function __construct($id, $nom, $prenom, $adresse, $cp, $ville){
			
			$this->_id 		= $id;
			$this->_nom 	= $nom;
			$this->_prenom 	= $prenom;
			$this->_adresse = $adresse;
			$this->_cp		= $cp;
			$this->_ville	= $ville;
			
		}
		
		public function __destruct(){}
		
		//GET
		public function getClientID(){
			
			return $this->_id;
		
		}
		
		public function getClientName(){
			
			return $this->_nom;
		
		}
		
		public function getClientFirstname(){
			
			return $this->_prenom;
		
		}
		
		public function getClientAddress(){
			
			return $this->_adresse;
		}
		
		public function getClientCP(){
			
			return $this->_cp;
		
		}
		
		public function getClientTown(){
			
			return $this->_ville;
			
		}
		
		public function getClientFacture($numfac){
			
			return $this->_facture[$numfac];

		}
		
		//SET
		public function setClientID($mID){
			
			$this->_id = $mID;
		 
		}
		
		public function setClientName($mNom){
			
			$this->_nom = $mNom;
		
		}
		
		public function setClientFirstname($mPrenom){
			
			$this->_prenom = $mPrenom;
		 
		}
		
		public function setClientAddress($mAdresse){
			
			$this->_adresse = $mAdresse;
		 
		}
		
		public function setClientCP($mCP){
			
			$this->_cp = $mCP;
		
		}
		
		public function setClientTown($mVille){
			
			$this->_ville = $mVille;
		 
		}
		
		public function setClientFacture($numFac,$fDate,$Qcomm,$TVA,$produit){
			
			$this->_facture[$numFac] = new Facture($numFac,$fDate,$Qcomm,$TVA,$produit);
 
		}
		
		public function afficheClient(){
			
			echo "N° Client : ".$this->_id;
			echo "<br/>".$this->_nom;
			echo " ".$this->_prenom;
			echo "<br/>".$this->_adresse;
			echo "<br/>".$this->_cp;
			echo " ".$this->_ville;
			echo "<br/>";
			
			
		}
		
		public function afficheUneFacture($numFac){
			
			$this->afficheClient();
			echo $this->_facture[$numFac]->afficheFacture($numFac);
			
		}
		
		public function afficheAllFacture(){
			
			//On affiche toutes les factures du client
			for($i=0;$i<count($this->_facture);$i++){
				
				echo $this->_facture[$i]->afficheFacture($i);
				
			}
			
		}
		
	} // Fin de définition de la classe client
	
	class Facture{
		
		private $_id;
		private $_date;
		private $_montantTTC;
		private $_detail;
		private $_incremDetail;

		public function __construct($idFac, $date, $Qcomm, $TVA, $produit){
			
			$this->_id 			= $idFac;
			$this->_date 		= $date;
			$this->_montantTTC	= $Qcomm*(($produit->_prixHT)*(1+$TVA/100));
			$this->_incremDetail= 0;
			$this->_detail[$this->_incremDetail] = new D_facture($Qcomm, $TVA, $produit);
			
		}
		
		public function __destruct(){}
		
		//GET
		public function getFacID(){
			
			return $this->_id;
		
		}
		
		public function getFacDate(){
			
			return $this->_date;
		
		}
		
		public function getFacMontant(){
			
			return $this->_montantTTC;
		
		}
		
		public function getFacDetail(){
			
			return $this->_detail;
		
		}
		
		//SET
		public function setFacID($mID){
			
			$this->_id = $mID;
		 
		}
		
		public function setFacDate($mDate){
			
			$this->_date = $mDate;
		
		}
		
		public function setFacMontant($mMontantTTC){
			
			$this->_montantTTC = $mMontantTTC;
		 
		}
		
		public function setFacDetail($numFac,$Qcomm,$TVA,$produit){
			
			//On incrémente la ligne de facture
			$this->_incremDetail++;
			
			//On rentre les nouveau produit acheté
			$this->_detail[$this->_incremDetail] = new D_facture($Qcomm,$TVA,$produit);
			
			//On met à jour le montant de la facture
			$this->_montantTTC = ($this->_montantTTC) + $Qcomm*(($produit->_prixHT)*(1+$TVA/100));
		 
		}
		
		public function afficheFacture($numFac){
			
			//On affiche les informations de la facture
			echo "<br/>Facture n°".$this->_id;
			echo " du ".$this->_date;
			
			//On affiche le détail de la commande dans un tableau
			echo "<table style=\"border: 1px solid; text-align: center;\">";
				
				echo "<tr>";
					echo "<th>Produit";
					echo "<th>Quantité commandée</th>";
					echo "<th>Prix HT";
					echo "<th>TVA</th>";
				echo "</tr>";
				
			for($i=0;$i<count($this->_detail);$i++){
				
				echo $this->_detail[$i]->afficheDetails();
				
			}
			
			echo "</table>";
			
			//On affiche le montant de la commande
			echo "<h3>Total : ".$this->_montantTTC;
			echo "€<br/></h3>";
		

		}
		
	} // Fin de définition de la classe facture

	class Produit{
		
		public $_id;
		public $_libelle;
		public $_prixHT;
		private $_Qstock;

		public function __construct($id, $libelle, $prixHT, $Qstock){
			
			$this->_id 		= $id;
			$this->_libelle = $libelle;
			$this->_prixHT	= $prixHT;
			$this->_Qstock	= $Qstock;
			
		}
		
		public function __destruct(){}
		
		//GET
		public function getProID(){
			
			return $this->_id;
		
		}
		
		public function getProLibelle(){
			
			return $this->_libelle;
		
		}
		
		public function getProPrix(){
			
			return $this->_prixHT;
		
		}
		
		public function getProStock(){
			
			return $this->_Qstock;
		
		}
		
		//SET
		public function setProID($mID){
			
			$this->_id = $mID;
		 
		}
		
		public function setProLibelle($mLibelle){
			
			$this->_libelle = $mLibelle;
		
		}
		
		public function setProPrix($mPrix){
			
			$this->_prixHT = $mPrix;
		 
		}
		
		public function setProStock($mStock){
			
			$this->_Qstock = $mStock;
		 
		}
		
		public function afficheProduit(){
		
			//On affiche les données des produits dans un tableau
			echo "<table style=\"border: 1px solid; text-align: center;\">";
				
				echo "<tr>";
					echo "<th>N° produit</th>";
					echo "<th>Libellé</th>";
					echo "<th>Prix HT</th>";
					echo "<th>Quantité en stock</th>";
				echo "</tr>";
				
				echo "<tr>";
					echo "<td>".$this->_id;
					echo "</td><td>".$this->_libelle;
					echo "</td><td>".$this->_prixHT;
					echo " €</td><td>".$this->_Qstock;
				echo "</tr>";
				
			echo "</table>";
			
		}
		
	} // Fin de définition de la classe produit
	
	class D_facture{
		
		private $_quantite;
		private $_TVA;
		private $_produit;

		public function __construct($quantite,$tva,$produit){
			
			$this->_quantite= $quantite;
			$this->_TVA		= $tva;
			$this->_produit = $produit;
		}
		
		public function __destruct(){}
		
		//GET
		public function getDetQ(){
			
			return $this->_quantite;
		
		}
		
		public function getDetTaxe(){
			
			return $this->_TVA;
		
		}
		
		//SET
		public function setDetQ($mQ){
			
			$this->_quantite	= $mQ;
		 
		}
		
		public function setDetTaxe($mTaxe){
			
			$this->_TVA = $mTaxe;
		
		}
		
		public function afficheDetails(){
			
			//On affiche les détails des factures dans une ligne du tableau de la facture
				echo "<tr>";
					echo "<td>".$this->_produit->_libelle;
					echo "</td><td>".$this->_quantite;
					echo "</td><td>".$this->_produit->_prixHT;
					echo " € </td><td>".$this->_TVA;
				echo "</tr>";
			
		}
	
	} // Fin de définition de la classe détail de la facture


?>

<?php
	
	//Main
	
	//Tableau contenant les produits
	$items[0] = new Produit(1,"1kg patates douces",6,100);
	$items[1] = new Produit(2,"1kg pommes",3,100);
	$items[2] = new Produit(3,"1kg betteraves",5,100);
	$items[3] = new Produit(4,"1kg choux-fleurs",4,100);
	$items[4] = new Produit(5,"1kg pommes-de-terre",2.5,100);
	$items[5] = new Produit(6,"1kg fraises",10,100);
	
	//Création d'un nouveau client
	$myClient = new Client(1, " Dupont ", " Marc ", " 1 rue des Lilas ", 75000, " Paris ");
	
	//Création d'une nouvelle facture du client
	$myClient->setClientFacture(0,"14-05-2017",10,19.6,$items[0]);
	$myClient->setClientFacture(1,"14-05-2017",5,19.6,$items[5]);
	
	//Ajout d'articles à une facture
	$myClient->_facture[0]->setFacDetail(0,5,19.6,$items[4]);
	
	//Affichage de la facture
	$myClient->afficheUneFacture(0);
	
	/* 
	//On peut aussi afficher toutes les factures
	$myClient->afficheAllFacture(); 
	*/
	
?>
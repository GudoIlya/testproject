<?php 
Class CatalogueModel {

	private $catalogueH = array(
			array(
				'id'        => '1',
				'parent_id' => '0',
				'name'      => 'Каталог',
				'path'      => 'catalog',
				'descr'     => 'main catalog'
			),
			array(
				'id'        => '2',
				'parent_id' => '1',
				'name'      => 'Телевизоры',
				'path'      => 'tv',
				'descr'     => 'TV sets'
			),
			array(
				'id'        => '3',
				'parent_id' => '1',
				'name'      => 'ДВД-проигрыватели',
				'path'      =>  'dvd',
				'descr'     => 'DVD players'
			),
			array(
				'id'        => '4',
				'parent_id' => '2',
				'name'      => 'Samsung',
				'path'      => 'samsung',
				'descr'     => 'Samsung mnfctr'
			),
			array(
				'id'      => '5',
				'parent_id' => '4',
				'name'    => 'Телевизор Series 6',
				'path'    => 's6',
				'descr'   => 'TV set less then 42 inches'
			),
			array(
				'id'      => '6',
				'parent_id' => '4',
				'name'    => 'Телевизор Series 7',
				'path'    => 's7',
				'descr'   => 'TV set more then 42 inches'
			),
			array(
				'id'        => '7',
				'parent_id' => '3',
				'name'      => 'LG',
				'path'      => 'lg',
				'descr'     => 'LG is awesome'
			),
			array(
				'id'        => '8',
				'parent_id' => '7',
				'name'      => 'LG DVD',
				'path'      => 'lgdvd',
				'descr'     => 'plays everithing'
			)
	);

	private $hierarchyString;

	private function _buildHierarchy($path = "", $parent_id=0) {
		foreach ($this->catalogueH as $key => $catalogueEl) {
				if( $catalogueEl['parent_id'] == $parent_id ) {
					$newPath = $parent_id == 0 ? "/".PROJECT_NAME."/".$catalogueEl['path']."/" : $path.$catalogueEl['path']."/";
					$this->hierarchyString.="<ul><li><a href='{$newPath}'>".$catalogueEl['name']."</a>";
					$this->hierarchyString.= $this->_buildHierarchy($newPath, $catalogueEl['id']);
					$this->hierarchyString.= "</li></ul>";
					unset($this->catalogueH[$key]);
				}
		}
	}

	public function getHierarchy() {
		$this->_buildHierarchy();
		return $this->hierarchyString;
	}

	public function getDescription($path){
		foreach ($this->catalogueH as $key => $value) {
			if($value['path']==$path) {
				return $value['descr'];
			}
		}
	}

}
?>
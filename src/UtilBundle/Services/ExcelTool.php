<?php

namespace UtilBundle\Services;

use Doctrine\ORM\EntityManager;
use Liuggio\ExcelBundle\Factory;

class ExcelTool {

	private $container;
	private $filename;
	private $title;
	private $descripcion;
	private $createby = 'Gonzalez Automóviles';
	private $doctrine;
	private $phpexcel;
	private $body;
	private $head;

	/**
	 * @return mixed
	 */
	public function getContainer() {
		return $this->container;
	}

	/**
	 * @param mixed $container
	 */
	public function setContainer( $container ) {
		$this->container = $container;
	}

	/**
	 * @return mixed
	 */
	public function getFilename() {
		return $this->filename;
	}

	/**
	 * @param mixed $filename
	 */
	public function setFilename( $filename ) {
		$this->filename = $filename;
	}

	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}

	/**
	 * @return mixed
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}

	/**
	 * @param mixed $descripcion
	 */
	public function setDescripcion( $descripcion ) {
		$this->descripcion = $descripcion;
	}

	/**
	 * @return string
	 */
	public function getCreateby() {
		return $this->createby;
	}

	/**
	 * @param string $createby
	 */
	public function setCreateby( $createby ) {
		$this->createby = $createby;
	}

	/**
	 * @return mixed
	 */
	public function getDoctrine() {
		return $this->doctrine;
	}

	/**
	 * @param mixed $doctrine
	 */
	public function setDoctrine( $doctrine ) {
		$this->doctrine = $doctrine;
	}

	/**
	 * @return mixed
	 */
	public function getPhpexcel() {
		return $this->phpexcel;
	}

	/**
	 * @param mixed $phpexcel
	 */
	public function setPhpexcel( $phpexcel ) {
		$this->phpexcel = $phpexcel;
	}

	public function __construct( Factory $phpExcel, EntityManager $doctrine ) {
		$this->phpexcel = $phpExcel;
		$this->doctrine = $doctrine;

		$this->head = array(
			'allborders' =>
				array(
					'style' => 'thick',
					'color' => array( 'Hex' => '#000' )
				)
		);
		$this->body = array(
			'allborders' =>
				array(
					'style' => 'thin',
					'color' => array( 'Hex' => '#000' )
				)
		);
	}

	


}

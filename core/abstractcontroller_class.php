<?php

abstract class AbstractController {

	protected $view;
    protected $data, $user, $cfg, $utils;

	public function __construct($view,$objects) {
		$this->view = $view;
        $this->utils = $this->getUtilsObj();

        foreach ($objects as $k => $v) {
            $setter = 'set'. ucfirst($k);
            if (method_exists($this, $setter)) {
                $this->$setter($v);
            } else {
                $this->$k = $v;
            }
        }

//    echo "<pre> abstract class -- ";print_r($objects);echo "</pre>";

	}

	abstract protected function render($str);

	public function action404() {
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
	}


	// getters - setters

    /**
     * @return Utils object
     */
    public function getUtilsObj() { return (empty($this->utils)) ? new Utils() : $this->utils ; }

    /**
     * @return Data object
     */
    public function getData() { return $this->data; }


    /**
     * @param Data $data
     */
    public function setData(Data $data) { $this->data = $data; }

    /**
     * @return Visitor object
     */
    public function getUser() { return $this->user; }

    /**
     * @param Visitor $user
     */
    public function setUser(Visitor $user) { $this->user = $user; }

    /**
     * @return config array
     */
    public function getCfg() { return $this->cfg; }

    /**
     * @param array $cfg
     */
    public function setCfg(array $cfg) { $this->cfg = $cfg; }

}

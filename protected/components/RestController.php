<?
class RestController extends Controller{

    public function behaviors()
    {
        return array(
            'restAPI' => array('class' => '\rest\controller\Behavior')
        );
    }

    public function render($view, $data = null, $return = false, array $fields = null)
    {
        if (($behavior = $this->asa('restAPI')) && $behavior->getEnabled()) {
            return $this->renderRest($view, $data, $return, $fields);
        } else {
            return parent::render($view, $data, $return);
        }
    }

    public function redirect($url, $terminate = true, $statusCode = 302)
    {
        if (($behavior = $this->asa('restAPI')) && $behavior->getEnabled()) {
            $this->redirectRest($url, $terminate, $statusCode);
        } else {
            parent::redirect($url, $terminate, $statusCode);
        }
    }
}
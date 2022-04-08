<?php

declare(strict_types=1);

use Phalcon\Mvc\Controller;

class AddproductController extends Controller
{
    public function indexAction()
    {
        if ($_POST['name'] == null || $_POST['name'] == null || $_POST['name'] == null) {
            $this->view->message = "only price and stock can b empty";
        } else {
            $products = new Products();

            //assign value from the form to $user
            $products->assign(
                $this->request->getPost(),
                [
                    'name',
                    'description',
                    'tags',
                    'price',
                    'stock',
                ]
            );

            // Store and check for errors
            $success = $products->save();
            $this->view->success = $success;

            if ($success) {
                $eventHandler = $this->di->get('EventsManager');
                $eventHandler->fire('order:productsave',$this);
                $message = "Thanks for registering!";
            } else {
                $message = "error";
            }
        }

        // passing a message to the view
       
    }
    public function addAction()
    {
        $products = Products::find();
        $this->view->value =  $products;
    }
}

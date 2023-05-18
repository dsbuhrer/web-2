<?php
 
 namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Models\Categoria;
use App\Services\CategoriaService;
use App\Traits\ViewTrait;
use Exception;

class CategoriaController{

    use ViewTrait;

    public function __construct(CategoriaService $service)
    {
        $this->service = $service;
    }

    public function listPagina()
    {
        $categorias = $this->service->get();

        $this->view('categorias.index',["categorias" => $categorias]);
    }
    public function createPagina()
    {
        $this->view('categorias.create');
    }
    public function updatePagina($id)
    {
        $categoria = $this->service->find($id);

        $this->view('categorias.create',["categoria"=>$categoria]);
    }

    public function deletePagina($id)
    {
        $categoria = $this->service->find($id);

        $this->view('categorias.delete',["categoria"=>$categoria]);
    }

    public function update()
    {
        try {
            $cart = new Categoria(
                input()->post('id')->getValue(),
                input()->post('nome')->getValue(),
                input()->post('descricao')->getValue(),
            );

            Categoria::validate($cart);

            $this->service->update($cart);

            $categorias = $this->service->get();

            $this->view('categorias.index',["categorias" => $categorias,"success" => true]);
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->view('categorias.create',["success"=> false,"message"=> $message]);
        }
    }
    public function create()
    {

        try {
            $cart = new Categoria(
                null,
                input()->post('nome'),
                input()->post('descricao')
            );

            Categoria::validate($cart);

            $this->service->store($cart);

           $this->view('categorias.create',["success"=> true]);
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->view('categorias.create',["success"=> false,"message"=> $message]);
        }
    }
    public function delete($id)
    {
        try {
            $this->service->delete($id);
            $this->view('categorias.delete',["success"=> true]);
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            if (str_contains($message,'Cannot delete or update a parent row: a foreign key constraint fails')) {
                $message="A categoria não pode ser deletada porque está sendo usada";
                $this->view('categorias.delete',["success"=> false,"message"=> $message]);
            }else{
                $this->view('categorias.delete',["success"=> false,"message"=> $message]);
            }
        }

    }

    
}

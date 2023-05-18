<?php
 
 namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Models\Pagamento;
use App\Services\PagamentoService;
use App\Traits\ViewTrait;
use Exception;

class PagamentoController{

    use ViewTrait;

    public function __construct(PagamentoService $service)
    {
        $this->service = $service;
    }

    public function listPagina()
    {
        $pagamentos = $this->service->get();

        $this->view('pagamentos.index',["pagamentos" => $pagamentos]);
    }
    public function createPagina()
    {
        $this->view('pagamentos.create');
    }
    public function updatePagina($id)
    {
        $pagamento = $this->service->find($id);

        $this->view('pagamentos.create',["pagamento"=>$pagamento]);
    }

    public function deletePagina($id)
    {
        $pagamento = $this->service->find($id);

        $this->view('pagamentos.delete',["pagamento"=>$pagamento]);
    }

    public function update()
    {
        try {
            $cart = new Pagamento(
                input()->post('id')->getValue(),
                input()->post('nome')->getValue(),
            );

            Pagamento::validate($cart);

            $this->service->update($cart);

            $pagamentos = $this->service->get();

            $this->view('pagamentos.index',["pagamentos" => $pagamentos,"success" => true]);
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->view('pagamentos.create',["success"=> false,"message"=> $message]);
        }
    }
    public function create()
    {

        try {
            $cart = new Pagamento(
                null,
                input()->post('nome'),
            );

            Pagamento::validate($cart);

            $this->service->store($cart);

           $this->view('pagamentos.create',["success"=> true]);
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->view('pagamentos.create',["success"=> false,"message"=> $message]);
        }
    }
    public function delete($id)
    {
        try {
            $this->service->delete($id);
            $this->view('pagamentos.delete',["success"=> true]);
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            if (str_contains($message,'Cannot delete or update a parent row: a foreign key constraint fails')) {
                $message="A pagamento não pode ser deletada porque está sendo usada";
                $this->view('pagamentos.delete',["success"=> false,"message"=> $message]);
            }else{
                $this->view('pagamentos.delete',["success"=> false,"message"=> $message]);
            }
        }

    }

    
}

<?php
 
 namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Models\Lancamento;
use App\Services\CategoriaService;
use App\Services\LancamentoService;
use App\Services\PagamentoService;
use App\Traits\ViewTrait;
use Exception;

class LancamentoController{

    use ViewTrait;

    public function __construct(LancamentoService $service,PagamentoService $pagamento_service,CategoriaService $categoria_service)
    {
        $this->service = $service;
        $this->pagamento_service = $pagamento_service;
        $this->categoria_service = $categoria_service;
    }

    public function listPagina()
    {
        $lancamentos = $this->service->get();
        $pagamentos = $this->pagamento_service->get();
        $categorias = $this->categoria_service->get();
        $this->view('lancamentos.index',["lancamentos"=>$lancamentos,"pagamentos"=>$pagamentos,"categorias"=>$categorias]);
    }
    public function createPagina()
    {
        $pagamentos = $this->pagamento_service->get();
        $categorias = $this->categoria_service->get();
        $this->view('lancamentos.create',["pagamentos"=>$pagamentos,"categorias"=>$categorias]);
    }
    public function updatePagina($id)
    {
        $lancamento = $this->service->find($id);
        $pagamentos = $this->pagamento_service->get();
        $categorias = $this->categoria_service->get();
        $this->view('lancamentos.create',["lancamento"=>$lancamento,"pagamentos"=>$pagamentos,"categorias"=>$categorias]);
    }

    public function deletePagina($id)
    {
        $lancamento = $this->service->find($id);

        $this->view('lancamentos.delete',["lancamento"=>$lancamento]);
    }

    public function update()
    {
        try {
            $cart = new Lancamento(
                input()->post('id')->getValue(),
                input()->post('valor')->getValue(),
                input()->post('data_lancamento')->getValue(),
                input()->post('descricao')->getValue(),
                input()->post('tipo')->getValue(),
                input()->post('pagamento_id')->getValue(),
                input()->post('categoria_id')->getValue(),
            );

            Lancamento::validate($cart);

            $this->service->update($cart);

            $lancamentos = $this->service->get();
            $pagamentos = $this->pagamento_service->get();
            $categorias = $this->categoria_service->get();
            $this->view('lancamentos.index',["lancamentos"=>$lancamentos,"pagamentos"=>$pagamentos,"categorias"=>$categorias]);
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->view('lancamentos.create',["success"=> false,"message"=> $message]);
        }
    }
    public function create()
    {

        try {
            $cart = new Lancamento(
                null,
                input()->post('valor')->getValue(),
                input()->post('data_lancamento')->getValue(),
                input()->post('descricao')->getValue(),
                input()->post('tipo')->getValue(),
                input()->post('pagamento_id')->getValue(),
                input()->post('categoria_id')->getValue(),
            );

            Lancamento::validate($cart);

            $this->service->store($cart);

           $this->view('lancamentos.create',["success"=> true]);
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->view('lancamentos.create',["success"=> false,"message"=> $message]);
        }
    }
    public function delete($id)
    {
        try {
            $this->service->delete($id);
            $this->view('lancamentos.delete',["success"=> true]);
            
        } catch (Exception $e) {
            $message = $e->getMessage();
            if (str_contains($message,'Cannot delete or update a parent row: a foreign key constraint fails')) {
                $message="A lancamento não pode ser deletada porque está sendo usada";
                $this->view('lancamentos.delete',["success"=> false,"message"=> $message]);
            }else{
                $this->view('lancamentos.delete',["success"=> false,"message"=> $message]);
            }
        }

    }

    
}

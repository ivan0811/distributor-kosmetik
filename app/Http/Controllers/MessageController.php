<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    private function toast($icon, $message){
        return "<script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast.fire({
                icon: '".$icon."',
                title: '".$message."'
            })
            $('#error_modal').modal('show');
        </script>";
    }    

    public function successToast($message){        
        return $this->toast('success', $message);
    }

    public function dangerToast($message){
        return $this->toast('error', $message);
    }

    public function warningToast($message){
        return $this->toast('warning', $message);
    }

    public function infoToast($message){
        return $this->toast('info', $message);
    }    

    private function confirmModal($title, $message, $id, $button_submit, $button_back = ''){
        return '<div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="confirm_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">            
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">'.$title.'</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">                
              <p class="card-text">'.$message.'</p>
            </div>
            <div class="modal-footer">       
                '.$button_back.'                  
                '.$button_submit.'                
            </div>
          </div>
        </div>
      </div>';
    }

    public function saveConfirm($message, $location, $id, $confirm_id){
        return $this->confirmModal('Konfirmasi Perubahan','Apakah anda yakin kembali sebelum menyimpan perubahan pada data '.$message.'?', $id, '<button type="button" class="btn btn-primary" id="'.$confirm_id.'">Simpan</button>', '<a href="'.$location.'" class="btn btn-secondary">Kembali</a>');
    }            

    public function deleteConfirm($message, $id, $confirm_id){        
        return $this->confirmModal('Konfiramsi Hapus','Apakah anda yakin menghapus data '.$message.'?', $id,  '<button type="button" class="btn btn-custom-danger" id="'.$confirm_id.'">Hapus</button>', '<button class="btn btn-secondary" data-dismiss="modal">Batal</button>');
    }   
}

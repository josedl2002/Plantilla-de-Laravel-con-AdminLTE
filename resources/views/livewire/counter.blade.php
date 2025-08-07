<div class="container mt-5">  <!-- Solo un div raíz -->
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-4 text-primary">Contador</h2>
                    
                    <div class="display-4 fw-bold mb-4">
                        {{ $count }}
                    </div>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <button 
                            wire:click="decrement" 
                            class="btn btn-danger btn-lg rounded-circle"
                            style="width: 60px; height: 60px;"
                        >
                            -
                        </button>
                        
                        <button 
                            wire:click="increment" 
                            class="btn btn-success btn-lg rounded-circle"
                            style="width: 60px; height: 60px;"
                        >
                            +
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">{{\Auth::user()->name}}</h4>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="{{\Auth::user()->avatar}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="fieldsModal" tabindex="-1" aria-labelledby="fieldsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fieldsModalLabel">Seleziona Specializzazioni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($fields as $field)
                <div class="form-check">
                    <input type="checkbox" name="fields[]" class="form-check-input" value="{{ $field->id }}" id="field-{{ $field->id }}">
                    <label class="form-check-label" for="field-{{ $field->id }}">{{ $field->name }}</label>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Conferma Selezioni</button>
            </div>
        </div>
    </div>
</div>
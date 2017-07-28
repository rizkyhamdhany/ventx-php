<form class="horizontal-form"  action="{{route('app.ticket.book.post')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="ticket_type" value="Reguler">
    <input type="hidden" name="ticket_period" value="Presale 1">
<div class="form-action">
    <div class="table-scrollable">
        <table class="table table-ticket table-striped table-hover">
            <thead>
            <tr>
                <th> Ticket Type </th>
                <th> Availability </th>
                <th> Price </th>
                <th> Quantity </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> Reguler </td>
                <td> 700 </td>
                <td> IDR 700.000 </td>
                <td>
                    <div class="form-group">
                        <select class="form-control" name="ticket_ammount">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </td>

            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-2 col-md-8 margin-top-30">
            <button type="button" class="btn grey-salsa btn-outline" id="reg-cancel">Cancel</button>
            <button type="submit" class="btn green">Continue</button>
        </div>
    </div>
</div>
</form>
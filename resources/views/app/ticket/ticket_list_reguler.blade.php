<form class="horizontal-form"  action="{{route('app.ticket.book.post')}}" method="POST" onsubmit="document.getElementById('ticket_ammount').disabled = false;">
    {{ csrf_field() }}
    <input type="hidden" name="book" value="" id="book">
<div class="form-action">
    <div class="table-scrollable">
        <table class="table table-ticket table-striped table-hover">
            <thead>
            <tr>
                <th> Ticket Type </th>
                <th> Price </th>
                <th> Quantity </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td id="ticket-class"> Reguler </td>
                <td id="ticket-price"> IDR 125.000 </td>
                <td>
                    <div class="form-group">
                        <select class="form-control" name="ticket_ammount" id="ticket_ammount">
                            <option value="0">-----</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
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
        <button type="submit" class="btn sm-button btn-block">Proceed</button>
    </div>
</div>
</form>
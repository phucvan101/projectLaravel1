<td>
    @if($order->status == 'pending')
    <span class="badge badge-warning">Pending</span>
    @elseif($order->status == 'confirmed')
    <span class="badge badge-primary">Confirmed</span>
    @elseif($order->status == 'shipping')
    <span class="badge badge-info">Shipping</span>
    @elseif($order->status == 'delivered')
    <span class="badge badge-success">Delivered</span>
    @elseif($order->status == 'cancelled')
    <span class="badge badge-danger">Cancelled</span>
    @else
    <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
    @endif
</td>
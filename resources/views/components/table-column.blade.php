    @props(['product'])
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                          <img width="100" src="{{ $product->picture }}" alt="Product Image">
                        </td>
                        <td>{{ $product->price }} RS/-</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->soldQuantity }} Items</td>
                        <td>
                          @php
                            $earned = $product->price * $product->soldQuantity;
                            $totalQty = $product->quantity + $product->soldQuantity;
                            $amountSpent = $totalQty * $product->wholeSalePrice;
                            $profitLoss = $earned - $amountSpent;
                            // dd($profitLoss);
                          @endphp
                          @if($profitLoss < 0)
                            <p class="text-red text-bold">{{ $profitLoss }} RS - loss</p>
                          @elseif($profitLoss > 0)
                            <p class="text-green text-bold">{{ $profitLoss }} RS - profit</p>
                          @else 
                            <p class="text-bold">No profit and loss</p>
                          @endif
                        </td>
                        <td>
                              @if($product->status)
                                <button 
                                    data-slug="{{ $product->slug }}"
                                    onmouseout="setShadow('{{ $product->id }}', 'hover:border-green-500', 'border-green-700')" 
                                    onmouseover="setNoShadow('{{ $product->id }}', 'hover:border-green-500', 'border-green-700')" 
                                    id="button-{{ $product->id }}" 
                                    class="status-btn active bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 rounded"
                                >
                                  Actived
                                </button>
                                {{-- @dd(($product->price * $product->soldQuantity) ) --}}
                                {{-- @dd(($product->quantity + $product->soldQuantity) * $product->wholeSalePrice)  --}}
                               
                              @else 
                                <button 
                                  data-slug="{{ $product->slug }}"
                                  onmouseout="setShadow('{{ $product->id }}', 'hover:border-red-500', 'border-red-700')" 
                                  onmouseover="setNoShadow('{{ $product->id }}', 'hover:border-red-500', 'border-red-700')" 
                                  id="button-{{ $product->id }}" 
                                  class="status-btn deactive bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded"
                                >
                                    Deactived
                                </button>
                            @endif
                        </td>
                      </tr>
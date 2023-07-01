// <tr>
//     <td>{{ $product->name }}</td>
//     <td>
//       <img width="100" src="{{ $product->picture }}" alt="Product Image">
//     </td>
//     <td>{{ $product->price }} RS/-</td>
//     <td>{{ $product->quantity }}</td>
//     <td>{{ $product->soldQuantity }} Items</td>
//     <td>
//       @if($product->profit < 0)
//         <p class="text-red text-bold">{{ $product->profit }} RS - loss</p>
//       @elseif($product->profit > 0)
//         <p class="text-green text-bold">{{ $product->profit }} RS - profit</p>
//       @else 
//         <p class="text-bold">No profit and loss</p>
//       @endif
//     </td>
//     <td>
//           @if($product->status)
//             <button 
//                 data-slug="{{ $product->slug }}"
//                 onmouseout="setShadow('{{ $product->id }}', 'hover:border-green-500', 'border-green-700')" 
//                 onmouseover="setNoShadow('{{ $product->id }}', 'hover:border-green-500', 'border-green-700')" 
//                 id="button-{{ $product->id }}" 
//                 class="status-btn active bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 rounded"
//             >
//               Actived
//             </button>
//           @else 
//             <button 
//               data-slug="{{ $product->slug }}"
//               onmouseout="setShadow('{{ $product->id }}', 'hover:border-red-500', 'border-red-700')" 
//               onmouseover="setNoShadow('{{ $product->id }}', 'hover:border-red-500', 'border-red-700')" 
//               id="button-{{ $product->id }}" 
//               class="status-btn deactive bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded"
//             >
//                 Deactived
//             </button>
//         @endif
//     </td>
//   </tr>
// @push('scripts')
// @endpush
const profitLoss = profit => {
    let message = "";
    if(profit < 0) {
        message = `<p class="text-red text-bold">${profit} RS - loss</p>`
        return [message, 1];
    } else if(profit > 0) {
        message = `<p class="text-green text-bold">${profit} RS - profit</p>`
        return [message, 1];    
    } else {
        message = `<p class="text-bold">No profit and loss</p>`
        return [message, 0];
    }
}
const getStatus = product => {
    if(product.status) {
        return `
        
                        <button 
                            onclick="updateStatus(${product.id})"
                            data-slug="${product.slug}"
                            onmouseout="setShadow('${product.id}', 'hover:border-green-500', 'border-green-700')" 
                            onmouseover="setNoShadow('${product.id}', 'hover:border-green-500', 'border-green-700')" 
                            id="button-${product.id}" 
                            class="status-btn active bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 rounded"
                        >
                        Actived
                        </button>
                    `;
    } else {
        return `
        <button
            onclick="updateStatus(${product.id})"
            data-slug="${product.slug}"
            onmouseout="setShadow('${product.id}', 'hover:border-red-500', 'border-red-700')" 
            onmouseover="setNoShadow('${product.id}', 'hover:border-red-500', 'border-red-700')" 
            id="button-${product.id}" 
            class="status-btn deactive bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded"
        >
          Deactived
      </button>
    `;
    }
}
const getAmount = product => {
    const earned = product.price * product.soldQuantity
    const totalQty = product.quantity + product.soldQuantity;
    const amountSpent = totalQty * product.wholeSalePrice;
    const profitLoss = earned - amountSpent;
    return profitLoss;
}


const HTMLtemplate = product => {
    const [message, status] = profitLoss(getAmount(product));
    const url = new URL(window.location.href);
    const pathname = url.pathname;
    const pathArr = pathname.split("/");
    const subject = dictionary(pathArr[2]);
    return `   
        <tr>     
        <td>${product.name}</td>
        <td style="${ (!product.picture)? "display: none" : "" }">
        <img width="100" src="/uploads/${product.picture}" alt="Product Image">
        </td>
        <td style="${ (!product.price)? "display: none" : "" }">${product.price} RS/-</td>
        <td style="${ (!product.quantity)? "display: none" : "" }">${product.quantity}</td>
        <td style="${ (!product.hasOwnProperty("soldQuantity"))? "display: none" : "" }">${product.soldQuantity} Items</td>
        <td style="${ (!status)? "display: none" :  ""}">
            ${profitLoss(getAmount(product))}
        </td>
        <td>
            ${getStatus(product)}
        </td>
        <td>
        <a href="/admin/${subject}/${product.slug}/edit" data-id="${product.id}" class="inline-block update-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Update
        </a>
        <button onclick="deleteItem('/admin/${subject}/${product.slug}/delete')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            Delete
        </button>
        </td>
        </tr>
    `
}
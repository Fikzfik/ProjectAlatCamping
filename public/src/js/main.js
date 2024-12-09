function toggleDropdown1() {
    const dropdownList1 = document.getElementById('dropdownList1');
    const arrowIcon1 = document.getElementById('arrowIcon1');
    const listItems1 = document.querySelectorAll('#dropdownList1 li');  // Ambil semua elemen <li>

    if (dropdownList1.classList.contains('max-h-0')) {
        // Buka dropdown
        dropdownList1.classList.remove('max-h-0');
        dropdownList1.classList.add('max-h-[20vw]');  // Sesuaikan dengan tinggi konten
        arrowIcon1.classList.add('rotate-180');  // Rotasi ikon panah ke bawah

        // Tampilkan <li> satu per satu
        listItems1.forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-x-[-110%]');
                li.classList.add('opacity-100', 'translate-x-0');
            }, index * 100);  // Delay 100ms untuk tiap elemen
        });

    } else {
        // Tutup dropdown
        dropdownList1.classList.remove('max-h-[20vw]');
        dropdownList1.classList.add('max-h-0');
        arrowIcon1.classList.remove('rotate-180');  // Reset rotasi panah

        // Sembunyikan <li>
        listItems1.forEach((li) => {
            li.classList.add('opacity-0', 'translate-x-[-110%]');
            li.classList.remove('opacity-100', 'translate-x-0');
        });
    }
}

function toggleDropdown2() {
    const dropdownList2 = document.getElementById('dropdownList2');
    const arrowIcon2 = document.getElementById('arrowIcon2');
    const listItems2 = document.querySelectorAll('#dropdownList2 li');  // Ambil semua tag <li>

    if (dropdownList2.classList.contains('max-h-0')) {
        // Buka accordion
        dropdownList2.classList.remove('max-h-0');
        dropdownList2.classList.add('max-h-[10vw]');  // Sesuaikan dengan tinggi konten
        arrowIcon2.classList.add('rotate-180');  // Putar ikon panah

        // Animasikan setiap <li>
        listItems2.forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-x-[-100%]');
                li.classList.add('opacity-100', 'translate-x-0');
            }, index * 100);  // Delay 100ms antara tiap elemen
        });

    } else {
        // Tutup accordion
        dropdownList2.classList.remove('max-h-[10vw]');
        dropdownList2.classList.add('max-h-0');
        arrowIcon2.classList.remove('rotate-180');  // Kembalikan rotasi panah

        // Sembunyikan kembali <li>
        listItems2.forEach((li) => {
            li.classList.add('opacity-0', 'translate-x-[-100%]');
            li.classList.remove('opacity-100', 'translate-x-0');
        });
    }
}

function toggleDropdown3() {
    const dropdownList3 = document.getElementById('dropdownList3');
    const arrowIcon3 = document.getElementById('arrowIcon3');
    const listItems3 = document.querySelectorAll('#dropdownList3 li');  // Ambil semua tag <li>

    if (dropdownList3.classList.contains('max-h-0')) {
        // Buka accordion
        dropdownList3.classList.remove('max-h-0');
        dropdownList3.classList.add('max-h-[10vw]');  // Sesuaikan dengan tinggi konten
        arrowIcon3.classList.add('rotate-180');  // Putar ikon panah

        // Animasikan setiap <li>
        listItems3.forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-x-[-100%]');
                li.classList.add('opacity-100', 'translate-x-0');
            }, index * 100);  // Delay 100ms antara tiap elemen
        });

    } else {
        // Tutup accordion
        dropdownList3.classList.remove('max-h-[10vw]');
        dropdownList3.classList.add('max-h-0');
        arrowIcon3.classList.remove('rotate-180');  // Kembalikan rotasi panah

        // Sembunyikan kembali <li>
        listItems3.forEach((li) => {
            li.classList.add('opacity-0', 'translate-x-[-100%]');
            li.classList.remove('opacity-100', 'translate-x-0');
        });
    }
}

function toggleDropdown4() {
    const dropdownList4 = document.getElementById('dropdownList4');
    const arrowIcon4 = document.getElementById('arrowIcon4');
    const listItems4 = document.querySelectorAll('#dropdownList4 li');  // Ambil semua elemen <li>

    if (dropdownList4.classList.contains('max-h-0')) {
        // Buka dropdown
        dropdownList4.classList.remove('max-h-0');
        dropdownList4.classList.add('max-h-[13vw]');  // Sesuaikan dengan tinggi konten
        arrowIcon4.classList.add('rotate-180');  // Rotasi ikon panah

        // Tampilkan <li> satu per satu
        listItems4.forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-x-[-100%]');
                li.classList.add('opacity-100', 'translate-x-0');
            }, index * 100);  // Delay 100ms untuk tiap elemen
        });

    } else {
        // Tutup dropdown
        dropdownList4.classList.remove('max-h-[13vw]');
        dropdownList4.classList.add('max-h-0');
        arrowIcon4.classList.remove('rotate-180');  // Reset rotasi panah

        // Sembunyikan <li>
        listItems4.forEach((li) => {
            li.classList.add('opacity-0', 'translate-x-[-100%]');
            li.classList.remove('opacity-100', 'translate-x-0');
        });
    }
}

function toggleDropdown5() {
    const dropdownList5 = document.getElementById('dropdownList5');
    const arrowIcon5 = document.getElementById('arrowIcon5');
    const listItems5 = document.querySelectorAll('#dropdownList5 li');  // Ambil semua tag <li>

    if (dropdownList5.classList.contains('max-h-0')) {
        // Buka accordion
        dropdownList5.classList.remove('max-h-0');
        dropdownList5.classList.add('pt-[4.651vw]');
        dropdownList5.classList.add('max-h-[51.395vw]');  // Sesuaikan tinggi dropdown
        arrowIcon5.classList.remove('rotate-180');  // Putar ikon panah

        // Animasikan setiap <li>
        listItems5.forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-x-[-100%]');
                li.classList.add('opacity-100', 'translate-x-0');
            }, index * 100);  // Delay 100ms untuk setiap elemen
        });

    } else {
        // Tutup accordion
        dropdownList5.classList.remove('max-h-[51.395vw]');
        dropdownList5.classList.add('max-h-0');
        dropdownList5.classList.remove('pt-[4.651vw]');
        arrowIcon5.classList.add('rotate-180');  // Kembalikan rotasi panah

        // Sembunyikan kembali <li>
        listItems5.forEach((li) => {
            li.classList.add('opacity-0', 'translate-x-[-100%]');
            li.classList.remove('opacity-100', 'translate-x-0');
        });
    }
}

function toggleDropdown6() {
    const dropdownList6 = document.getElementById('dropdownList6');
    const arrowIcon6 = document.getElementById('arrowIcon6');
    const listItems6 = document.querySelectorAll('#dropdownList6 li');  // Ambil semua tag <li>

    if (dropdownList6.classList.contains('max-h-0')) {
        // Buka accordion
        dropdownList6.classList.remove('max-h-0');
        dropdownList6.classList.add('max-h-[22vw]');  // Sesuaikan tinggi dropdown
        arrowIcon6.classList.add('rotate-180');  // Putar ikon panah

        // Animasikan setiap <li>
        listItems6.forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-x-[-100%]');
                li.classList.add('opacity-100', 'translate-x-0');
            }, index * 100);  // Delay 100ms untuk setiap elemen
        });

    } else {
        // Tutup accordion
        dropdownList6.classList.remove('max-h-[22vw]');
        dropdownList6.classList.add('max-h-0');
        arrowIcon6.classList.remove('rotate-180');  // Kembalikan rotasi panah

        // Sembunyikan kembali <li>
        listItems6.forEach((li) => {
            li.classList.add('opacity-0', 'translate-x-[-100%]');
            li.classList.remove('opacity-100', 'translate-x-0');
        });
    }
}

function toggleDropdown7() {
    const dropdownList7 = document.getElementById('dropdownList7');
    const arrowIcon7 = document.getElementById('arrowIcon7');
    const listItems7 = document.querySelectorAll('#dropdownList7 li');  // Ambil semua elemen <li>

    if (dropdownList7.classList.contains('max-h-0')) {
        // Buka accordion
        dropdownList7.classList.remove('max-h-0');
        dropdownList7.classList.add('max-h-[15vw]');  // Sesuaikan tinggi dropdown
        arrowIcon7.classList.add('rotate-180');  // Putar ikon panah

        // Animasikan setiap <li>
        listItems7.forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-x-[-100%]');
                li.classList.add('opacity-100', 'translate-x-0');
            }, index * 100);  // Delay 100ms untuk setiap elemen
        });

    } else {
        // Tutup accordion
        dropdownList7.classList.remove('max-h-[15vw]');
        dropdownList7.classList.add('max-h-0');
        arrowIcon7.classList.remove('rotate-180');  // Kembalikan rotasi panah

        // Sembunyikan kembali <li>
        listItems7.forEach((li) => {
            li.classList.add('opacity-0', 'translate-x-[-100%]');
            li.classList.remove('opacity-100', 'translate-x-0');
        });
    }
}

function toggleDropdown8() {
    const dropdownList8 = document.getElementById('dropdownList8');
    const arrowIcon8 = document.getElementById('arrowIcon8');
    const listItems8 = document.querySelectorAll('#dropdownList8 li');  // Ambil semua elemen <li>

    if (dropdownList8.classList.contains('max-h-0')) {
        // Buka accordion
        dropdownList8.classList.remove('max-h-0');
        dropdownList8.classList.add('pt-[4.651vw]');
        dropdownList8.classList.add('max-h-[60.814vw]');  // Sesuaikan tinggi dropdown
        arrowIcon8.classList.add('rotate-180');  // Putar ikon panah

        // Animasikan setiap <li>
        listItems8.forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-x-[-100%]');
                li.classList.add('opacity-100', 'translate-x-0');
            }, index * 100);  // Delay 100ms untuk setiap elemen
        });

    } else {
        // Tutup accordion
        dropdownList8.classList.remove('max-h-[60.814vw]');
        dropdownList8.classList.add('max-h-0');
        dropdownList8.classList.remove('pt-[4.651vw]');
        arrowIcon8.classList.remove('rotate-180');  // Kembalikan rotasi panah

        // Sembunyikan kembali <li>
        listItems8.forEach((li) => {
            li.classList.add('opacity-0', 'translate-x-[-100%]');
            li.classList.remove('opacity-100', 'translate-x-0');
        });
    }
}

function productDetails() {
    const productDetail1 = document.getElementById('ProductDetail');
    const arrowIcon9 = document.getElementById('arrowIcon9');
    const detailsList1 = document.querySelectorAll('#productDetailsList li');
    const featuresList1 = document.querySelectorAll('#featuresList li');
    const careList1 = document.querySelectorAll('#careInstructionsList li');

    if (productDetail1.classList.contains('max-h-0')) {
        // Buka accordion
        productDetail1.classList.remove('max-h-0');
        productDetail1.classList.add('max-h-[93.721vw]'); // Sesuaikan dengan tinggi konten
        arrowIcon9.classList.add('rotate-180'); // Putar ikon panah
        productDetail1.classList.add('pt-[5.581vw]');

        // Animasi elemen <li> untuk Product Details
        [...detailsList1, ...featuresList1, ...careList1].forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-y-[-100%]');
                li.classList.add('opacity-100', 'translate-y-0');
            }, index * 100);  // Delay 100ms untuk setiap elemen
        });

    } else {
        // Tutup accordion
        productDetail1.classList.remove('max-h-[93.721vw]');
        productDetail1.classList.add('max-h-0');
        arrowIcon9.classList.remove('rotate-180'); // Kembalikan rotasi panah
        productDetail1.classList.remove('pt-[5.581vw]');
        // Sembunyikan elemen <li> kembali
        [...detailsList1, ...featuresList1, ...careList1].forEach((li) => {
            li.classList.add('opacity-0', 'translate-y-[-100%]');
            li.classList.remove('opacity-100', 'translate-y-0');
        });
    }
}

function moreInfo() {
    const moreInfoContent = document.getElementById('moreInfo');
    const arrowIcon10 = document.getElementById('arrowIcon10');
    const moreInfoText = moreInfoContent.querySelector('p');

    if (moreInfoContent.classList.contains('max-h-0')) {
        // Buka accordion
        moreInfoContent.classList.remove('max-h-0');
        moreInfoContent.classList.add('max-h-[30vw]'); // Sesuaikan dengan tinggi konten
        arrowIcon10.classList.add('rotate-180'); // Putar ikon panah
        moreInfoContent.classList.add('pt-[5.581vw]');

        // Animasi muncul dari kiri untuk paragraf
        setTimeout(() => {
            moreInfoText.classList.remove('opacity-0', 'translate-y-[-100%]');
            moreInfoText.classList.add('opacity-100', 'translate-y-0');
        }, 100);  // Delay animasi 100ms
    } else {
        // Tutup accordion
        moreInfoContent.classList.remove('max-h-[30vw]');
        moreInfoContent.classList.add('max-h-0');
        arrowIcon10.classList.remove('rotate-180');
        moreInfoContent.classList.remove('pt-[5.581vw]'); // Kembalikan rotasi panah

        // Sembunyikan teks kembali
        moreInfoText.classList.add('opacity-0', 'translate-y-[-100%]');
        moreInfoText.classList.remove('opacity-100', 'translate-y-0');
    }
} 

function productDetails2() {
    const productDetail2 = document.getElementById('ProductDetail2');
    const arrowIcon11 = document.getElementById('arrowIcon11');
    const detailsList2 = document.querySelectorAll('#productDetailsList2 li');
    const featuresList2 = document.querySelectorAll('#featuresList2 li');
    const careList2 = document.querySelectorAll('#careInstructionsList2 li');

    if (productDetail2.classList.contains('max-h-0')) {
        // Buka accordion
        productDetail2.classList.remove('max-h-0');
        productDetail2.classList.add('max-h-[50vw]'); // Sesuaikan dengan tinggi konten
        arrowIcon11.classList.add('rotate-180'); // Putar ikon panah

        // Animasi elemen <li> untuk Product Details
        [...detailsList2, ...featuresList2, ...careList2].forEach((li, index) => {
            setTimeout(() => {
                li.classList.remove('opacity-0', 'translate-y-[-100%]');
                li.classList.add('opacity-100', 'translate-y-0');
            }, index * 100);  // Delay 100ms untuk setiap elemen
        });

    } else {
        // Tutup accordion
        productDetail2.classList.remove('max-h-[50vw]');
        productDetail2.classList.add('max-h-0');
        arrowIcon11.classList.remove('rotate-180'); // Kembalikan rotasi panah

        // Sembunyikan elemen <li> kembali
        [...detailsList2, ...featuresList2, ...careList2].forEach((li) => {
            li.classList.add('opacity-0', 'translate-y-[-100%]');
            li.classList.remove('opacity-100', 'translate-y-0');
        });
    }
}

function moreInfo2() {
    const moreInfoContent2 = document.getElementById('moreInfo2');
    const arrowIcon12 = document.getElementById('arrowIcon12');
    const moreInfoText = moreInfoContent2.querySelector('p');

    if (moreInfoContent2.classList.contains('max-h-0')) {
        // Buka accordion
        moreInfoContent2.classList.remove('max-h-0');
        moreInfoContent2.classList.add('max-h-[10vw]'); // Sesuaikan dengan tinggi konten
        arrowIcon12.classList.add('rotate-180'); // Putar ikon panah

        // Animasi muncul dari kiri untuk paragraf
        setTimeout(() => {
            moreInfoText.classList.remove('opacity-0', 'translate-y-[-100%]');
            moreInfoText.classList.add('opacity-100', 'translate-y-0');
        }, 100);  // Delay animasi 100ms
    } else {
        // Tutup accordion
        moreInfoContent2.classList.remove('max-h-[10vw]');
        moreInfoContent2.classList.add('max-h-0');
        arrowIcon12.classList.remove('rotate-180'); // Kembalikan rotasi panah

        // Sembunyikan teks kembali
        moreInfoText.classList.add('opacity-0', 'translate-y-[-100%]');
        moreInfoText.classList.remove('opacity-100', 'translate-y-0');
    }
}

function searching() {
    const dropdown = document.getElementById('searchBar');
    
    if(dropdown.classList.contains('hidden')){
        dropdown.classList.remove('hidden');
        dropdown.classList.add('flex');
    }else{
        dropdown.classList.add('hidden');
        dropdown.classList.remove('flex');
    }
}
let quantity = 1;

function increment() {
    quantity++;
    document.getElementById("quantity").innerText = quantity;
}

function decrement() {
    if (quantity > 1) { // Batas minimal quantity 1
        quantity--;
        document.getElementById("quantity").innerText = quantity;
    }
}

let quantity1 = 1;

function increment1() {
    quantity1++;
    document.getElementById("quantity1").innerText = quantity1;
}

function decrement1() {
    if (quantity1 > 1) { // Batas minimal quantity 1
        quantity1--;
        document.getElementById("quantity1").innerText = quantity1;
    }
}

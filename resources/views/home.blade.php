<x-guest-layout>
    <div class="flex flex-col-reverse justify-center lg:gap-16 lg:flex-row lg:items-center">
        <div class="lg:w-1/2">
            <h1 class="text-4xl text-center font-bold sm:text-6xl lg:text-left">Consignment <span class="text-rose-600">Shop</span></h1>
            <p class="mt-8 text-lg lg:text-xl">
                A specific kind of resale shop, known as a consignment shop, offers merchandise for
                display in exchange for a share of the final sale price. In this retails business model,
                customers bring in goods and are paid once the goods are sold. Clothing, furniture, shoes,
                musical instruments, and even books can be purchased from consignment stores.
            </p>
        </div>

        <div class="flex justify-center">
            <img src="{{ Vite::image('cart-card.png') }}" alt="" />
        </div>
    </div>
</x-guest-layout>

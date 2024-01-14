<table {{ $attributes->class(['w-full']) }}>
    <thead>
        <tr class="border-y border-gray-200 bg-gray-50">
            {{ $header }}
        </tr>
    </thead>

    <tbody>
        {{ $body }}
    </tbody>
</table>

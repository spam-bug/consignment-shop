<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 48px;
        }

        h1,
        h2,
        h3 {
            font-size: 16px;
        }

        p,
        ol,
        ul {
            line-height: 2;
        }

        .text-center {
            text-align: center;
        }

        .mt-12 {
            margin-top: 40px;
        }

        .mt-16 {
            margin-top: 64px;
        }

        .underline {
            text-decoration: underline;
        }

        .page-break {
            page-break-after: always;
        }

        table {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        tr,
        td,
        th {
            border: 1px solid black;
            text-align: left;
        }

        th {
            padding: 4px 16px;
        }

        td {
            padding: 8px 16px;
        }
    </style>
</head>

<body>
    <h1 class="text-center">CONSIGNMENT AGREEMENT</h1>

    <p class="mt-12">KNOW ALL MEN BY THESE PRESENTS:</p>

    <p class="mt-12">
        This Consignment Agreement (the "Agreement") is entered into this {{ date('d') }} day of {{ date('F Y') }}
        at City/Municipality of Bataan Province of Orani by and between:
    </p>

    <p class="mt-12">
        {{ $consignor->business->name }} a stock corporation duly organized and validly existing under and by virtue of the laws of the Philippines,
        with principal address at company address represented in this act by {{ $consignor->user->name }} who holds the following position: owner
        hereinafter referred to as the
    </p>

    <p class="text-center">CONSIGNOR</p>

    <p class="mt-12 text-center">-and-</p>

    <p class="mt-12">
        {{ auth()->user()->consignee->business->name }} a stock corporation duly organized and validly existing under and by virtue of the laws of the
        Philippines,
        with principal address at company address represented in this act by {{ auth()->user()->name }} who holds the following position: owner
        hereinafter referred to as the
    </p>

    <p class="text-center">CONSIGNEE</p>

    <p class="mt-16 text-center">
        The CONSIGNOR and the CONSIGNEE will be referred to collectively as the "Parties".
    </p>

    <h2 class="mt-16 text-center">WITNESSETH THAT:</h2>

    <p>WHEREAS, CONSIGNOR desires to offer the certain products on consignment;</p>
    <p>WHEREAS, CONSIGNEE desires to sell the Product on behalf of CONSIGNOR;</p>
    <p>NOW THEREFORE, for and in consideration of the foregoing premises, and the terms and conditions herein set forth, the Parties agree:</p>

    <h3 class="mt-16">I. GOODS</h3>
    <p>The following product or products (the "Products") shall be sold on consignment:</p>
    <ul>
        @foreach ($shortlists as $shortlist)
            <li>{{ $shortlist->product->name }}</li>
        @endforeach
    </ul>

    <h3 class="mt-12">II. TITLE AND CONSIGNMENT OF GOODS</h3>
    <p>
        CONSIGNOR owns the Product until the same is purchased or CONSIGNEE fails to return the same
        within the period agreed upon by the Parties. CONSIGNOR grants CONSIGNEE the right to sell the Product.
    </p>

    <h3 class="mt-12">III. DELIVERY, ACCEPTANCE, AND SALE OF GOODS</h3>
    <p>
        CONSIGNOR undertakes to supply and deliver the Product to CONSIGNEE for sale on consignment
        as agreed upon by the Parties.
    </p>
    <p>
        CONSIGNEE undertakes to accept the delivery of the Product and to devote its best effor for the
        sale of the Product. CONSIGNEE shall inspect the Product upon delivery and, if the Product is
        found to have any damage or deterioration, CONSIGNEE may choose to accept or reject delivery.
        if CONSIGNEE chooses to accept delivery, CONSIGNEE shall make a written statement of any damages
        or deterioration of the Product otherwise the same shall be considered as to have been received in good condition.
    </p>
    <p>
        CONSIGNEE hereby acknowledges and agrees that delivery and acceptance of the Product is for the purpose
        of the sale of the Product on consignment basis, that it does not have any right, title, or interest
        in and to the Product, and that the Product is not intended as a security of any kind.
    </p>

    <h3 class="mt-12">IV. PROMOTIONAL AND ADVERTISING MATERIALS</h3>
    <p>
        CONSIGNOR shall provide marketing, promotional, and advertising materials to CONSIGNEE to
        display or use to encourage sales of the Product, CONSIGNEE reserves the right to approve any
        materials that will be displayed, which approval shall not be unreasonably withheld.
    </p>

    <div class="page-break"></div>

    <h3 class="mt-12">V. SELLING PRICE</h3>
    <p>
        CONSIGNEE undertakes to sell the Product at reasonable and affordable prices even with mark-up provided
        that CONSIGNEE shall not sell the Product below the following prices (the "Selling Price"):
    </p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Selling Price (Peso)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shortlists as $shortlist)
                <tr>
                    <td>{{ $shortlist->product->name }}</td>
                    <td>{{ $shortlist->product->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="mt-12">VI. SALE ON CREDIT</h3>
    <p>
        CONSIGNEE shall not sell the Product on credit or installments. Any sale made on credit or
        installments shall be fully paid by the CONSIGNEE as if the same was fully paid at the time of the sale.
    </p>

    <h3 class="mt-12">VII. PAYMENT AND FEES</h3>
    <p>
        Upon sale of the Product, CONSIGNEE shall send the Selling Price to CONSIGNOR within Fourteen (14) Days.
    </p>
    <p>
        CONSIGNEE shall keep the difference between the Selling Price and the actual price paid by the buyer
        as the CONSIGNEE's fee under this Agreement.
    </p>

    <h3 class="mt-12">VIII. INVENTORY AND RECORDS</h3>
    <p>
        CONSIGNEE shall conduct an inventory of the Product every first working day of the month.
        CONSIGNOR may observe the inventory taking at its discretion. CONSIGNEE shall also maintain
        accurate records of sale that CONSIGNOR may inspect upon reasonable notice.
    </p>

    <h3 class="mt-12">IX. LOSS AND DAMAGE</h3>
    <p>
        CONSIGNEE shall be liable for any loss, damage, deterioration, or destruction of the Product
        caused by the acts or negligence of the CONSIGNEE. Any loss, damage, deterioration, or
        destruction of the Product shall be presumed to have been caused by the acts or negligence of
        the CONSIGNEE unless the CONSIGNEE proves otherwise except if the loss, damage, deterioration,
        or destruction of the product was caused by fortuitous events beyond the control of
        CONSIGNEE or acts of God which could not be reasonably foreseen or though foreseen, could
        not be reasonably avoided, in which case, the presumption shall not arise.
    </p>
    <p>
        CONSIGNOR holds CONSIGNEE free from any liability for loss, damage, deterioration, or,
        destruction of the Product arising from fortuitous events beyond the control of CONSIGNEE or
        acts of God which could not be reasonably foreseen or though foreseen could not be reasonable avoided.
    </p>

    <h3 class="mt-12">X. FORTUITOUS EVENTS</h3>
    <p>
        Neither party shall be liable for any breach of this Agreement if the same is due to fortuitous
        events beyond its control or acts of God which could not be reasonably foreseen or through
        foreseen could not be reasonably avoided.
    </p>

    <h3 class="mt-12">XI. INDEMNITY</h3>
    <p>
        Each Party hereby agrees to indemnify and hold harmless the other Party, their employees and
        representatives against any and all damage, liability and loss, as well as legal fees and costs
        incurred that may arise or otherwise relate to this Agreement except if, upon final judgment, a
        competent court finds that the bad faith, gross negligence, or willful misconduct of one Party
        caused the damage, liability and loss in which case no indemnification shall be provided for the said Party.
    </p>

    <h3 class="mt-12">XII. DURATION AND TERMINATION</h3>
    <p>
        This Agreement shall be valid from {{ now()->format('d F Y') }} to {{ now()->addYear()->format('d F Y') }}
        but may be terminated earlier upon mutual agreement of the parties in writing.
    </p>
    <p>This Agreement may be renewed upon mutual agreement of the parties in writing.</p>
    <p>Notwithstanding the foregoing, this Agreement may validly be terminated upon Fourteen (14) Days notice in writing</p>
    <ol>
        <li>By a party for material breach of the terms and conditions of this Agreement of the other party;</li>
        <li>By a party for the closure, dissolution, insolvency, or bankruptcy, whether voluntary or involuntary, of the other party;</li>
        <li>By the CONSIGNOR, if there is no or minimal effort to sell the Product from the CONSIGNEE;</li>
        <li>By the CONSIGNEE, if the Product is not selling despite best effor;</li>
        <li>By a party for other similar causes.</li>
    </ol>

    <h3 class="mt-12">XIII. RETURN OF THE GOODS</h3>
    <p>
        Upon the termination of this Agreement for whatever reason, CONSIGNEE shall return the unsold
        Product and any unused promotional materials to CONSIGNOR within the following period
        ("return period"): 1 Month from the date of termination.
    </p>

    <p>
        CONSIGNOR shall arrange for and bear all the costs and expenses for the return of the Product.
        CONSIGNOR shall give CONSIGNEE a Two (2) Working Day notice of the date when the Product
        will be collected from the CONSIGNEE. If CONSIGNOR fails to arrange for the return of the Product
        within the return period through no fault of the CONSIGNEE, CONSIGNEE may charge reasonable storage
        fees from the day after the last day of the return period until the Products have been returned to CONSIGNOR.
    </p>

    <p>
        If CONSIGNEE fails to return the Product on the date arraged for by the CONSIGNOR for no valid reason
        or otherwise delays the return of the Product through no fault of the CONSIGNOR, ownership of the
        Product shall automatically transfer to CONSIGNEE on the day after the last day of the return period and
        CONSIGNEE shall be liable to pay the Selling Price to the CONSIGNOR.
    </p>

    <h3 class="mt-12">XIV. CONFIDENTIALITY</h3>
    <p>
        Each Party hereby acknowledges and agrees that they and the other Party each possess certain
        non- public Confidential Information (as herein defined) and may also possess Trade Secret
        Information (as herein defined) (collectively, the "Proprietary Information") regarding their
        business operations and development. The Parties agree that the Proprietary Information is
        secret and valuable to each of their respective businesses and the Parties have entered into a
        business relationship, through which they will. each have access to the other Party's Proprietary
        Information. Each of the Parties desires to maintain the secret and private nature of any
        Proprietary Information given. "Receiving Party" refers to the Party that is receiving the Proprietary
        Information and "Disclosing Party" refers to the Party that is disclosing the Proprietary Information.
    </p>

    <ol>
        <li>
            Confidential Information refers to any information which is confidential and commercially
            valuable to either of the Parties. The Confidential Information may be in the form of documents,
            techniques, methods, practices, tools, specifications, inventions, patents, trademarks, copyrights,
            equipment, algorithms, models, samples, software, drawings, sketches, plans, programs, or other
            oral or written knowledge and/or secrets and may pertain to, but is not limited to, the fields of
            research and development, forecasting, marketing, personnel, customers, suppliers, intellectual
            property, and/or finance or any other information which is confidential and commercially valuable
            to either of the Parties.

            Confidential Information may or may not be disclosed as such, through labeling, but is considered
            any information which ought to be treated as confidential under the circumstances through which
            it was disclosed.

            Confidential Information shall not mean any information which:

            <ol style="margin-left: 32px">
                <li>
                    is known or available to the public at the time of disclosure or became known or
                    available after disclosure through no fault of the Receiving Party;
                </li>
                <li>
                    is already known, through legal means, to the Receiving Party;
                </li>
                <li>
                    is given to the Receiving Party by any third party who legally had the Confidential
                    Information and the right to disclose it; or
                </li>
                <li>
                    is developed independently by the Receiving Party and the Receiving Party can
                    show such independent development.
                </li>
            </ol>
        </li>

        <li>
            "Trade Secret Information shall be defined specifically as any formula, process, method,
            pattern, design, or other information that is not known or reasonably ascertainable by the public,
            consumers, or competitors through which, and because of such secrecy, an economic or
            commercial advantage can be achieved.
        </li>

        <li>
            Both Parties hereby agree they shall:

            <ol style="margin-left: 32px">
                <li>
                    Not disclose the Proprietary Information via any unauthorized means to any third
                    parties throughout the duration of this Agreement and the Parties' relationship with each
                    other;
                </li>
                <li>
                    Not disclose the Confidential Information via any unauthorized means to any
                    third parties for a period of Three (3) Years following the termination of this Agreement;
                </li>
                <li>
                    Not disclose the Trade Secret Information forever, or for as long as such
                    information remains a trade secret under applicable law, whichever occurs first, to any
                    third party at any time;
                </li>
                <li>
                    Not use the Confidential Information or the Trade Secret Information for any
                    purpose except those contemplated herein or expressly authorized by the Disclosing
                    Party.
                </li>
            </ol>
        </li>
    </ol>

    <h3 class="mt-12">XV. RELATIONSHIP OF THE PARTIES</h3>
    <p>
        The Parties hereby acknowledge and agree that nothing in this Agreement shall be deemed to
        constitute a partnership, joint venture, agency or employment relationship or otherwise between
        the Parties and that this Agreement is for the sole and express purpose of the consignment and
        sale of the Product.
    </p>

    <h3 class="mt-12">XVI. SUPPORTING DOCUMENTS AND ADDITIONAL ACTS</h3>
    <p>
        The Parties agree to execute such other documents as are reasonable and necessary for the
        proper implementation of this Agreement.
    </p>

    <h3 class="mt-12">XVII. APPLICABLE LAW</h3>
    <p>
        This Agreement shall be governed by and construed in accordance with the laws of the Republic
        of the Philippines.
    </p>

    <h3 class="mt-12">XVIII. HEADINGS</h3>
    <p>
        Headings are for convenience only and do not affect the interpretation of this Agreement.
    </p>

    <h3 class="mt-12">XIX. ASSIGNMENT</h3>
    <p>
        This Agreement, or the rights hereunder, may not be assigned, sold, leased, or otherwise
        transferred in whole or party by either Party
    </p>

    <h3 class="mt-12">XX. SUCCESSORS AND ASSIGNS</h3>
    <p>
        This Contract shall be binding on the successors and assigns of both Parties.
    </p>

    <h3 class="mt-12">XXI. ENTIRETY OF AGREEMENT</h3>
    <p>
        This Agreement represents the entire agreement between CONSIGNOR and CONSIGNEE and
        supersedes all prior negotiations, representations, agreements, either oral or written.
    </p>

    <h3 class="mt-12">XXII. AMENDMENTS AND MODIFICATIONS</h3>
    <p>
        This Agreement may be amended only by a written instrument signed and agreed upon by both
        Parties.
    </p>

    <p class="mt-16">
        IN WITNESS WHEREOF, the Parties have hereunto affixed their signatures on the date and place
        first stated above.
    </p>

    <p class="mt-16 text-center">
        _____________________________
    </p>
    <p class="text-center">Consignee</p>
    <p class="text-center">By:</p>
    <p class="text-center">Name of consignee</p>
    <p class="text-center">{{ auth()->user()->name }}</p>

    <p class="mt-16 text-center">
        _____________________________
    </p>
    <p class="text-center">Consignor</p>
    <p class="text-center">By:</p>
    <p class="text-center">Name of consignor</p>
    <p class="undeline text-center">{{ $consignor->user->name }}</p>
</body>

</html>

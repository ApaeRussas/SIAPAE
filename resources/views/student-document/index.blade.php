<x-app-layout>

<div class="documents-list-page">

    <x-slot name="header">
        <div class="documents-header">
            <div>
                <h2>Lista de Documentos</h2>
                <p>Consulte e gerencie os documentos dos estudantes.</p>
            </div>
        </div>
    </x-slot>

    <div class="documents-page-content">

        <div class="documents-card">

            {{-- Barra de busca e ação --}}
            <div class="documents-toolbar">

                <form
                    method="GET"
                    action="{{ route('student-documents.index') }}"
                    class="documents-search"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="search-icon"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 1 1-13.5 0 6.75 6.75 0 0 1 13.5 0Z"
                        />
                    </svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Buscar pelo nome do aluno"
                    >

                    <button type="submit">
                        Buscar
                    </button>
                </form>

                @if (auth()->user())
                    <a
                        href="{{ route('student-documents.create') }}"
                        class="add-document-button"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="19"
                            height="19"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4v16m8-8H4"
                            />
                        </svg>

                        <span>Adicionar documento</span>
                    </a>
                @endif

            </div>

            {{-- Lista --}}
            @if ($documents->count() > 0)

                <div class="documents-table-container">

                    <table class="documents-table">

                        <thead>
                            <tr>
                                <th class="student-column">
                                    ESTUDANTE
                                </th>

                                <th class="type-column">
                                    TIPO DO DOCUMENTO
                                </th>

                                <th class="document-column">
                                    DOCUMENTO
                                </th>

                                <th class="date-column">
                                    DATA DE CADASTRO
                                </th>

                                <th class="actions-column">
                                    AÇÕES
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($documents as $document)

                                <tr>

                                    <td>
                                        <div class="student-name">
                                            {{ $document->student->name ?? '—' }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="document-type">
                                            {{ $document->document_type }}
                                        </span>
                                    </td>

                                    <td>
                                        <div
                                            class="document-name"
                                            title="{{ $document->original_name }}"
                                        >
                                            {{ $document->original_name }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="document-date">
                                            {{ $document->created_at?->format('d/m/Y') }}
                                        </span>
                                    </td>

                                    <td class="actions-column">

                                        <div class="document-actions">

                                            <a
                                                href="{{ route('student-documents.download', $document) }}"
                                                class="action-button action-download"
                                                title="Baixar documento"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="17"
                                                    height="17"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"
                                                    />
                                                </svg>
                                            </a>

                                            @if (auth()->user())

                                                <form
                                                    method="POST"
                                                    action="{{ route('student-documents.destroy', $document) }}"
                                                    onsubmit="return confirm('Tem certeza que deseja excluir este documento?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="action-button action-delete"
                                                        title="Excluir documento"
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="17"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M6 7h12m-10 0v12h8V7M9 7V4h6v3m-3 4v5"
                                                            />
                                                        </svg>
                                                    </button>
                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-documents">

                    <div class="empty-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="30"
                            height="30"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M7 3h7l5 5v13H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14 3v6h5M9 13h6M9 17h6"
                            />
                        </svg>

                    </div>

                    <h3>Nenhum documento encontrado.</h3>

                    <p>
                        @if (!empty($search))
                            Nenhum documento foi encontrado para "{{ $search }}".
                        @else
                            Os documentos cadastrados aparecerão aqui.
                        @endif
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

<style>

    /* =========================================================
       PÁGINA
    ========================================================= */

    .documents-list-page {
        width: 100%;
        min-height: calc(100vh - 64px);
        background: transparent;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* =========================================================
       TÍTULO
    ========================================================= */

    .documents-header {
        width: calc(100% - 64px);
        max-width: 1400px;
        margin: 0 auto;
        padding: 16px 0 12px;
        box-sizing: border-box;
    }

    .documents-header h2 {
        margin: 0;
        color: #000;
        font-size: 27px;
        font-weight: 700;
        line-height: 1.2;
    }

    .documents-header p {
        margin: 5px 0 0;
        color: #62746B;
        font-size: 15px;
        line-height: 1.4;
    }

    /* =========================================================
       CONTEÚDO
    ========================================================= */

    .documents-page-content {
        width: calc(100% - 64px);
        max-width: 1400px;
        margin: 0 auto;
        padding: 4px 0 24px;
        box-sizing: border-box;
    }

    /* =========================================================
       CARD PRINCIPAL
    ========================================================= */

    .documents-card {
        width: 100%;
        background: #fff;
        border: 1px solid #DCE7E1;
        border-radius: 18px;
        overflow: hidden;
        box-sizing: border-box;
    }

    /* =========================================================
       BARRA SUPERIOR
    ========================================================= */

    .documents-toolbar {
        width: 100%;
        min-height: 72px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        border-bottom: 1px solid #DCE7E1;
        background: #fff;
        box-sizing: border-box;
    }

    /* =========================================================
       BUSCA
    ========================================================= */

    .documents-search {
        flex: 1 1 auto;
        min-width: 220px;
        height: 46px;
        display: flex;
        align-items: center;
        border: 1px solid #D7E2DC;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-sizing: border-box;
    }

    .search-icon {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        margin-left: 14px;
        color: #7A8D83;
    }

    .documents-search input {
        flex: 1;
        min-width: 0;
        height: 100%;
        border: none;
        outline: none;
        box-shadow: none;
        padding: 0 10px 0 12px;
        background: #fff;
        color: #334E68;
        font-size: 15px;
        box-sizing: border-box;
    }

    .documents-search input::placeholder {
        color: #718096;
    }

    .documents-search button {
        flex-shrink: 0;
        height: 36px;
        margin-right: 6px;
        padding: 0 18px;
        border: none;
        border-radius: 11px;
        background: #E7F1EB;
        color: #286048;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s ease;
    }

    .documents-search button:hover {
        background: #DCEBE2;
    }

    /* =========================================================
       BOTÃO ADICIONAR
    ========================================================= */

    .add-document-button {
        flex: 0 0 auto;
        height: 46px;
        min-width: 220px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        border-radius: 12px;
        background: #327A58;
        color: #fff !important;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none !important;
        box-sizing: border-box;
        transition: background .2s ease;
    }

    .add-document-button:hover {
        background: #245E43;
    }

    /* =========================================================
       TABELA
    ========================================================= */

    .documents-table-container {
        width: 100%;
        overflow-x: auto;
    }

    .documents-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .documents-table thead {
        background: #F1F5F2;
    }

    .documents-table th {
        height: 44px;
        padding: 0 18px;
        border-bottom: 1px solid #DCE7E1;
        color: #65786E;
        font-size: 12px;
        font-weight: 700;
        text-align: left;
        letter-spacing: .02em;
        white-space: nowrap;
        box-sizing: border-box;
    }

    .documents-table td {
        height: 52px;
        padding: 7px 18px;
        border-bottom: 1px solid #EDF1EE;
        color: #334E68;
        font-size: 13px;
        vertical-align: middle;
        box-sizing: border-box;
    }

    .documents-table tbody tr:last-child td {
        border-bottom: none;
    }

    .documents-table tbody tr:hover {
        background: #FAFCFB;
    }

    .student-column {
        width: 27%;
    }

    .type-column {
        width: 20%;
    }

    .document-column {
        width: 27%;
    }

    .date-column {
        width: 16%;
    }

    .actions-column {
        width: 10%;
        text-align: center !important;
    }

    /* =========================================================
       CONTEÚDO DAS CÉLULAS
    ========================================================= */

    .student-name {
        color: #263D32;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .document-type {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 7px;
        background: #E7F1EB;
        color: #286048;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .document-name {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #526A60;
    }

    .document-date {
        color: #62746B;
        white-space: nowrap;
    }

    /* =========================================================
       AÇÕES
    ========================================================= */

    .document-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .document-actions form {
        margin: 0;
        padding: 0;
    }

    .action-button {
        width: 31px;
        height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none !important;
        transition: background .2s ease;
    }

    .action-download {
        background: #E7F1EB;
        color: #286048;
    }

    .action-download:hover {
        background: #D6E9DD;
    }

    .action-delete {
        background: #FBEAEA;
        color: #B94A48;
    }

    .action-delete:hover {
        background: #F5D7D7;
    }

    /* =========================================================
       ESTADO VAZIO
    ========================================================= */

    .empty-documents {
        min-height: 245px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 30px 20px;
        box-sizing: border-box;
    }

    .empty-icon {
        width: 58px;
        height: 58px;
        margin-bottom: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: #E7F1EB;
        color: #327A58;
    }

    .empty-documents h3 {
        margin: 0;
        color: #000;
        font-size: 17px;
        font-weight: 700;
    }

    .empty-documents p {
        margin: 6px 0 0;
        color: #62746B;
        font-size: 14px;
        line-height: 1.4;
    }

    /* =========================================================
       RESPONSIVO
    ========================================================= */

    @media (max-width: 900px) {

        .documents-header,
        .documents-page-content {
            width: calc(100% - 36px);
        }

        .documents-toolbar {
            flex-wrap: wrap;
        }

        .documents-search {
            width: 100%;
            flex-basis: 100%;
        }

        .add-document-button {
            width: 100%;
            min-width: 0;
        }

    }

    @media (max-width: 640px) {

        .documents-header,
        .documents-page-content {
            width: calc(100% - 24px);
        }

        .documents-header {
            padding-top: 12px;
        }

        .documents-header h2 {
            font-size: 23px;
        }

        .documents-header p {
            font-size: 14px;
        }

        .documents-toolbar {
            padding: 12px;
        }

        .documents-table th,
        .documents-table td {
            padding-left: 12px;
            padding-right: 12px;
        }

        .empty-documents {
            min-height: 210px;
        }

    }

</style>


</x-app-layout>

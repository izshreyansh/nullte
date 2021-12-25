<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.png">
    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
</head>
<body>
<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <div id="app">
                    <div v-if="showLoading" class="loader"></div>
                    <b-card
                            header="Open Graph Tool"
                            header-tag="header"
                            sub-title="Generate OG previews in one click.">
                        <b-form>
                            <b-form-group
                                    label="Enter Url"
                                    description="Enter URL to generate a preview.">
                                <b-form-input
                                        v-model="userUrl"
                                        type="text"
                                        placeholder="https://facebook.com"
                                        required
                                ></b-form-input>
                            </b-form-group>
                            <br/>
                            <b-button @click="getPreview" href="#" variant="primary">Preview</b-button>
                        </b-form>
                    </b-card>
                    <br/>

                    <div v-if="userRepository.url">
                        <b-card
                                :title="userRepository.site_name"
                                :img-src="userRepository.image"
                                :img-alt="userRepository.site_name"
                                img-top
                                tag="article"
                                style="max-width: 20rem;"
                                class="mb-2"
                        >
                            <b-card-text>
                                <ul>
                                    <li>URL
                                        <span v-text="userRepository.url"></span>
                                    </li>
                                    <li>Locale
                                        <span v-text="userRepository.locale"></span>
                                    </li>
                                </ul>
                            </b-card-text>

                            <b-button @click="storeRepository" variant="primary">Save</b-button>
                        </b-card>
                    </div>

                    <div>
                        <b-pagination
                                v-model="currentPage"
                                :total-rows="rows"
                                :per-page="perPage"
                                aria-controls="repositories"
                        ></b-pagination>

                        <b-table
                                id="repositories"
                                striped
                                hover
                                :items="repositories"
                                :current-page="currentPage"
                                :fields="fields"
                                :per-page="perPage">
                            <!-- A virtual composite column -->
                            <template #cell(action)="data">
                                <b-button @click="removeRepository(data.item.id, data.index)" variant="danger">Delete</b-button>
                            </template>
                        </b-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

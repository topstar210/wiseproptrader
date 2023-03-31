@extends('layouts.auth_page')

@section('content')
    @include('dashboard.layouts.topbar')

    @include('dashboard.layouts.sidebar', ['pagename' => 'download'])

    <link rel="stylesheet" href="/css/dashboard/index.css">
    {{-- main --}}
    <div class="container-fluid">
        <div class="container p-5 client-area">
            <div class="pb-5 text-white">Trader / Download</div>

            <div class="books">
                <h4>Ebooks</h4>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/pdf.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>How To Receive Wiseprop Account?</span> <br>
                                    <span>Find out how to become Wiseprop Trader.</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/pdf.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>How To Receive Wiseprop Account?</span> <br>
                                    <span>Find out how to become Wiseprop Trader.</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/pdf.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>How To Receive Wiseprop Account?</span> <br>
                                    <span>Find out how to become Wiseprop Trader.</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/pdf.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>How To Receive Wiseprop Account?</span> <br>
                                    <span>Find out how to become Wiseprop Trader.</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Platforms mt-5">
                <h4>Platforms</h4>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-8 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/zip.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>Printable Wiseprop Posters</span>
                                </div>
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-end pe-3">
                                <a href="https://download.mql5.com/cdn/web/metaquotes.software.corp/mt4/MetaTrader4.dmg" target="_blank" title="Download" mac="" class="pl-3 ms-4 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="-1.5 0 20 20" version="1.1">
                                        <title>apple [#173]</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs>
                                    </defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Dribbble-Light-Preview" transform="translate(-102.000000, -7439.000000)" fill="#fff">
                                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                                    <path d="M57.5708873,7282.19296 C58.2999598,7281.34797 58.7914012,7280.17098 58.6569121,7279 C57.6062792,7279.04 56.3352055,7279.67099 55.5818643,7280.51498 C54.905374,7281.26397 54.3148354,7282.46095 54.4735932,7283.60894 C55.6455696,7283.69593 56.8418148,7283.03894 57.5708873,7282.19296 M60.1989864,7289.62485 C60.2283111,7292.65181 62.9696641,7293.65879 63,7293.67179 C62.9777537,7293.74279 62.562152,7295.10677 61.5560117,7296.51675 C60.6853718,7297.73474 59.7823735,7298.94772 58.3596204,7298.97372 C56.9621472,7298.99872 56.5121648,7298.17973 54.9134635,7298.17973 C53.3157735,7298.17973 52.8162425,7298.94772 51.4935978,7298.99872 C50.1203933,7299.04772 49.0738052,7297.68074 48.197098,7296.46676 C46.4032359,7293.98379 45.0330649,7289.44985 46.8734421,7286.3899 C47.7875635,7284.87092 49.4206455,7283.90793 51.1942837,7283.88393 C52.5422083,7283.85893 53.8153044,7284.75292 54.6394294,7284.75292 C55.4635543,7284.75292 57.0106846,7283.67793 58.6366882,7283.83593 C59.3172232,7283.86293 61.2283842,7284.09893 62.4549652,7285.8199 C62.355868,7285.8789 60.1747177,7287.09489 60.1989864,7289.62485" id="apple-[#173]">
                                    
                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                                <a href="https://download.mql5.com/cdn/web/ftmo.s.r/mt4/ftmo4setup.exe" target="_blank" title="Download" windows="" class="pl-3 ms-4 d-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 20 20" version="1.1">
                                        <title>windows [#174]</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs>
                                    </defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Dribbble-Light-Preview" transform="translate(-60.000000, -7439.000000)" fill="#fff">
                                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                                    <path d="M13.1458647,7289.43426 C13.1508772,7291.43316 13.1568922,7294.82929 13.1619048,7297.46884 C16.7759398,7297.95757 20.3899749,7298.4613 23.997995,7299 C23.997995,7295.84873 24.002005,7292.71146 23.997995,7289.71311 C20.3809524,7289.71311 16.7649123,7289.43426 13.1458647,7289.43426 M4,7289.43526 L4,7296.22153 C6.72581454,7296.58933 9.45162907,7296.94113 12.1724311,7297.34291 C12.1774436,7294.71736 12.1704261,7292.0908 12.1704261,7289.46524 C9.44661654,7289.47024 6.72380952,7289.42627 4,7289.43526 M4,7281.84344 L4,7288.61071 C6.72581454,7288.61771 9.45162907,7288.57673 12.1774436,7288.57973 C12.1754386,7285.96017 12.1754386,7283.34361 12.1724311,7280.72405 C9.44461153,7281.06486 6.71679198,7281.42567 4,7281.84344 M24,7288.47179 C20.3879699,7288.48578 16.7759398,7288.54075 13.1619048,7288.55175 C13.1598997,7285.88921 13.1598997,7283.22967 13.1619048,7280.56914 C16.7689223,7280.01844 20.3839599,7279.50072 23.997995,7279 C24,7282.15826 23.997995,7285.31353 24,7288.47179" id="windows-[#174]">
                                    
                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/zip.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>Printable Wiseprop Posters</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/zip.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>Printable Wiseprop Posters</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/zip.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>Printable Wiseprop Posters</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="Otheres mt-5">
                <h4>Otheres</h4>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/zip.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>Printable Wiseprop Posters</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/zip.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>Printable Wiseprop Posters</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/zip.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>Printable Wiseprop Posters</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet mt-3 p-3 rounded">
                    <div class="portlet__body py-0">
                        <div class="row h-54px">
                            <div class="col-10 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="https://cdn.ftmo.com/zip.svg" style="height: 50px">
                                </div>
                                <div class="px-3">
                                    <span>Printable Wiseprop Posters</span>
                                </div>
                            </div>
                            <a href="https://cdn.ftmo.com/ebook-how-to-receive-ftmo.pdf" title="Download" class="col-2 d-flex align-items-center justify-content-end pe-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="none">
                                    <path fill="#ffffff" fill-rule="evenodd" d="M11 2a1 1 0 10-2 0v7.74L5.173 6.26a1 1 0 10-1.346 1.48l5.5 5a1 1 0 001.346 0l5.5-5a1 1 0 00-1.346-1.48L11 9.74V2zm-7.895 9.204A1 1 0 001.5 12v3.867a2.018 2.018 0 002.227 2.002c1.424-.147 3.96-.369 6.273-.369 2.386 0 5.248.236 6.795.383a2.013 2.013 0 002.205-2V12a1 1 0 10-2 0v3.884l-13.895-4.68zm0 0L2.5 11l.605.204zm0 0l13.892 4.683a.019.019 0 01-.007.005h-.006c-1.558-.148-4.499-.392-6.984-.392-2.416 0-5.034.23-6.478.38h-.009a.026.026 0 01-.013-.011V12a.998.998 0 00-.394-.796z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            @include('dashboard.layouts.footer')
        </div>
    </div>
@endsection

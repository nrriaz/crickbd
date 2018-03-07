@extends('base_layout')


@section('page_content')

    {{--CSS--}}
    <link rel="stylesheet" href="/assets/css/details.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{--Fonts--}}
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">


    <div class="col-md-8 col-md-offset-2">
        <section id="main-body" style="margin-top: 50px;">
                    <div id="today-match">
                        <p class="team-name">EEE <span style="color: #636b6f;">vs</span> CSE</p>
                            <div>
                                <div class="match-detail-wrap">
                                    <p class="team-active">EEE <span class="run-active">125</span>/<span class="wicket">6</span> <span class="active-over"> (5.2 over)</span></p>
                                    <p class="inactive-team">Karachi Kings 225/6 (20 over)</p>
                                    <p class="inactive-team">Islamabad United need <span class="run-active">100</span> runs in <span class="ball-left">59</span> balls</p>
                                </div>
                            </div>
                    </div>
                    <div class="batting-table">
                        <p class="table-name">Bating Table</p>
                        <table>
                            <tr>
                                <th>Name(Jersey No)</th>
                                <th>Run(s)</th>
                                <th>Ball(s)</th>
                            </tr>
                            <tr>
                                <td>Sourav</td>
                                <td>54</td>
                                <td>65</td>
                            </tr>
                            <tr class="playing">
                                <td>Sourav</td>
                                <td>54</td>
                                <td>65</td>
                            </tr>
                            <tr class="out">
                                <td>Sourav Kumar Pramanik</td>
                                <td>54</td>
                                <td>65</td>
                            </tr>
                            <tr>
                                <td>Sourav</td>
                                <td>54</td>
                                <td>65</td>
                            </tr>
                            <tr>
                                <td>Sourav</td>
                                <td>54</td>
                                <td>65</td>
                            </tr>
                            <tr>
                                <td>Sourav</td>
                                <td>54</td>
                                <td>65</td>
                            </tr>
                        </table>
                    </div>
            <br>
            <div class="recent-notifications">
                <p>Partneership: 25 Runs from 16 ball(s)</p>
                <p>Recent Balls: 0 2 0 1 0 6 | 0 1 0 </p>
            </div>



            <div class="bowling-table">
                <p class="table-name">Bowling Table</p>
                <table>
                    <tr>
                        <th>Name(Jersey No)</th>
                        <th>Over(s)</th>
                        <th>Wicket(s)</th>
                    </tr>
                    <tr class="playing">
                        <td>Sourav</td>
                        <td>5.4</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>Sourav</td>
                        <td>5.4</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>Sourav</td>
                        <td>5.4</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>Sourav</td>
                        <td>5.4</td>
                        <td>2</td>
                    </tr>

                </table>
            </div>
            </section>
    </div>
@endsection
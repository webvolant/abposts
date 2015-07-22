
<div class="container filter portfolio">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="" ng-controller="frontCtrl">
                <div class="row form-inline  pull-right filters">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label>{!! trans("ablang.count_elements") !!}</label>
                        <select ng-model="entryLimit" ng-init="entryLimit" class="form-control">
                            <option value="entryLimit">7</option>
                            <option>12</option>
                            <option>20</option>

                        </select>
                        <label>  {!! trans("ablang.filter_by_text") !!}</label>
                        <input type="text" ng-model="query" ng-change="filter()" placeholder="{!! trans('ablang.was_suchen') !!}" class="form-control" />
                        <!--<input type="text" ng-model="id" ng-change="filter()" placeholder="ID Фильтр" class="form-control" />-->
                        <!--<h5>Фильтрация %% filtered.length %% из %% totalItems %% </h5>-->
                    </div>
                </div>


                <div class="row ">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                    <!--<a ng-click="sort_by('title');"><i class="glyphicon glyphicon-sort"></i> sorting by title</a>
                    <a ng-click="sort_by('id');"><i class="glyphicon glyphicon-sort"></i> sorting by id</a>
                    <a ng-click="sort_by('status');"><i class="glyphicon glyphicon-sort"></i> sorting by status</a>-->

                        <ul ng-show="filteredItems > 0">

                                    <li class="item animate-repeat" ng-repeat="data in filtered = (lister | filter:query | filter:{ id: id } | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                                        <div class="row ">
                                            <div class="col-xs-12 col-sm-12 col-md-12">

                                                <div class="portfolio_stack">
                                                    <div class="col-xs-12 col-sm-6 col-md-6 margin0">
                                                        <div class="portfolio_image_wrap" ><div class="cover_portfolio" style="background-image:url('%% data.large_thumb %%')"></div></div>
                                                    </div>
                                                        <div class="col-xs-12 col-sm-6 col-md-6 margin0">
                                                            <div class="description_portfolio" ng-bind-html="data.short_description_<?php echo App::getLocale(); ?>"></div>
                                                        </div>
                                                </div>

                                            </div>
                                        </div>
                                    </li>

                        </ul>

                        <div class="col-md-12" ng-show="filteredItems == 0">
                            <div class="col-md-12">
                                <h4>{!! trans("ablang.empty") !!}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12" ng-show="filteredItems > 0">
                        <div pagination="" page="currentPage" max-size="10" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="«" next-text="»"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>







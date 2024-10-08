<div>
    <x-slot name="header">Stock Details</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="text-3xl font-semibold text-pink-600 tracking-widest w-full">
            {{$stock->vname}} -[{{$stock->symbol}}]
        </div>

        <!-- Header --------------------------------------------------------------------------------------------------->
        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.header-serial wire:click.prevent="sortBy('vname')"/>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Date</x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Ltp</x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Changes</x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Change %</x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Volume</x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Open Interest</x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" center>Trend</x-table.header-text>
                <x-table.header-action/>
            </x-slot>

            <!-- Table Body ------------------------------------------------------------------------------------------->
            <x-slot name="table_body">
                @forelse ($list as $index =>  $row)
                    <x-table.row>
                        <x-table.cell-text center>
                            {{ $index + 1 }}
                        </x-table.cell-text>

                        <x-table.cell-text center>
                            <button wire:click="showDetailsRow({{$row->id}})">
                                {{ date('d-m-Y', strtotime($row->vdate)) }}
                            </button>
                        </x-table.cell-text>


                        <x-table.cell-text center>
                            {{ $row->ltp+0 }}
                        </x-table.cell-text>


                        <x-table.cell-text center>
                            {{ $row->chg+0 }}
                        </x-table.cell-text>


                        <x-table.cell-text center>
                            {{ $row->chg_percent+0 }}
                        </x-table.cell-text>


                        <x-table.cell-text center>
                            {{ $row->volume+0 }}
                        </x-table.cell-text>


                        <x-table.cell-text center>
                            {{ $row->open_interest+0 }}
                        </x-table.cell-text>


                        <x-table.cell-text center>
                            {{ $row->trend }}
                        </x-table.cell-text>

                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>

                    @if($showDetailsId === $row->id )
                        @if($showDetails)

                            <tr>
                                <th colspan="9">
                                    <div x-data @click.away="@this.set('showDetails', false)">
                                    <div class="w-full">
                                        <x-tabs.tab-panel>


                                            <x-slot name="tabs">
                                                <x-tabs.tab>Market</x-tabs.tab>
                                                <x-tabs.tab>Pivots</x-tabs.tab>
                                            </x-slot>

                                            <x-slot name="content">

                                                <x-tabs.content>
                                                    <div
                                                        class="grid grid-cols-2 gap-3 w-full divide-y divide-green-300">

                                                        <div
                                                            class="w-1/2 flex justify-between border-t border-green-300">
                                                            <span class="flex justify-end w-full">Open</span>
                                                            <span class="w-full">{{$row->open}}</span>
                                                        </div>

                                                        <div class="w-1/2 flex justify-between">
                                                            <span class="flex justify-end w-full">Prev Close</span>
                                                            <span class="w-full">{{$row->close}}</span>
                                                        </div>

                                                        <div class="w-1/2 flex justify-between">
                                                            <span class="flex justify-end w-full">Today-High</span>
                                                            <span class="w-full">{{$row->high}}</span>
                                                        </div>

                                                        <div class="w-1/2 flex justify-between">
                                                            <span class="flex justify-end w-full">Today-Low</span>
                                                            <span class="w-full">{{$row->low}}</span>
                                                        </div>

                                                        <div class="w-1/2 flex justify-between">
                                                            <span class="flex justify-end w-full">52 Week-High</span>
                                                            <span class="w-full">{{$row->high_52}}</span>
                                                        </div>

                                                        <div class="w-1/2 flex justify-between">
                                                            <span class="flex justify-end w-full">52 Week-Low</span>
                                                            <span class="w-full">{{$row->low_52}}</span>
                                                        </div>

                                                        <div class="w-1/2 flex justify-between">
                                                            <span class="flex justify-end w-full">All Time-High</span>
                                                            <span class="w-full">{{$row->all_high}}</span>
                                                        </div>

                                                        <div class="w-1/2 flex justify-between">
                                                            <span class="flex justify-end w-full">All Time-Low</span>
                                                            <span class="w-full">{{$row->all_low}}</span>
                                                        </div>

                                                    </div>
                                                </x-tabs.content>

                                                <x-tabs.content>
                                                    <div
                                                        class="grid grid-cols-3 gap-3 w-full divide-y divide-green-300">

                                                        <div class="flex justify-between border-t border-green-300">
                                                            <span class="flex justify-end w-full">R1</span>
                                                            <span class="w-full">{{$row->r1}}</span>
                                                        </div>

                                                        <div>&nbsp;</div>

                                                        <div class="flex justify-between">
                                                            <span class="flex justify-end w-full">S1</span>
                                                            <span class="w-full">{{$row->s1}}</span>
                                                        </div>

                                                        <div class="flex justify-between">
                                                            <span class="flex justify-end w-full">R2</span>
                                                            <span class="w-full">{{$row->r2}}</span>
                                                        </div>

                                                        <div class="flex justify-between">
                                                            <span class="flex justify-end w-full">Pivot</span>
                                                            <span class="w-full">{{$row->pivot}}</span>
                                                        </div>

                                                        <div class="flex justify-between">
                                                            <span class="flex justify-end w-full">S2</span>
                                                            <span class="w-full">{{$row->s2}}</span>
                                                        </div>

                                                        <div class="flex justify-between">
                                                            <span class="flex justify-end w-full">R3</span>
                                                            <span class="w-full">{{$row->r3}}</span>
                                                        </div>

                                                        <div>&nbsp;</div>

                                                        <div class="flex justify-between">
                                                            <span class="flex justify-end w-full">S3</span>
                                                            <span class="w-full">{{$row->s3}}</span>
                                                        </div>

                                                    </div>
                                                </x-tabs.content>

                                            </x-slot>

                                        </x-tabs.tab-panel>
                                    </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="9" class="bg-green-800">

                                </th>
                            </tr>

                        @endif
                    @endif

                @empty
                    <x-table.empty/>
                @endforelse
            </x-slot>

            <x-slot name="table_pagination">
                {{ $list->links() }}
            </x-slot>
        </x-forms.table>

        <x-modal.delete/>

        <!-- Create/ Edit Popup --------------------------------------------------------------------------------------->
        <x-forms.create :id="$vid" :max-width="'6xl'">

            <div class="flex flex-col gap-3 w-full">

                <div class="flex flex-row gap-3 w-full">
                    <div class="text-3xl font-semibold text-pink-600 py-2 tracking-widest w-full">
                        {{$stock->vname}}-{{$stock->symbol}}
                    </div>
                    <x-input.model-date wire:model="vdate" :label="'Date'"/>
                </div>

                <x-tabs.tab-panel>

                    <x-slot name="tabs">
                        <x-tabs.tab>Price</x-tabs.tab>
                        <x-tabs.tab>Market</x-tabs.tab>
                        <x-tabs.tab>Pivots</x-tabs.tab>
                    </x-slot>

                    <x-slot name="content">

                        <x-tabs.content>
                            <div class="grid grid-cols-2 gap-3 w-full">
                                <x-input.model-text wire:model="ltp" :label="'LTP'"/>
                                <x-input.model-text wire:model="chg" :label="'Changes'"/>
                                <x-input.model-text wire:model="chg_percent" :label="'Chg Percent %'"/>
                                <div>&nbsp;</div>
                                <x-input.model-text wire:model="volume" :label="'Volume'"/>
                                <x-input.model-text wire:model="open_interest" :label="'Open Interest'"/>
                            </div>
                        </x-tabs.content>

                        <x-tabs.content>
                            <div class="grid grid-cols-2 gap-3 w-full">
                                <x-input.model-text wire:model="open" :label="'Open'"/>
                                <x-input.model-text wire:model="close" :label="'Prev-Close'"/>
                                <x-input.model-text wire:model="high" :label="'Today-High'"/>
                                <x-input.model-text wire:model="low" :label="'Today-Low'"/>
                                <x-input.model-text wire:model="high_52" :label="'52 Weeks High'"/>
                                <x-input.model-text wire:model="low_52" :label="'52 Weeks Low'"/>
                                <x-input.model-text wire:model="all_high" :label="'AllTime High'"/>
                                <x-input.model-text wire:model="all_low" :label="'AllTime Low'"/>
                            </div>
                        </x-tabs.content>

                        <x-tabs.content>
                            <div class="grid grid-cols-3 gap-3 w-full">
                                <x-input.model-text wire:model="r1" tabindex="1" :label="'Resistance 1'"/>
                                <div>&nbsp;</div>
                                <x-input.model-text wire:model="s1" tabindex="5" :label="'Support 1'"/>

                                <x-input.model-text wire:model="r2" tabindex="2" :label="'Resistance 2'"/>
                                <x-input.model-text wire:model="pivot" tabindex="4" :label="'Pivot'"/>
                                <x-input.model-text wire:model="s2" tabindex="6" :label="'Support 2'"/>

                                <x-input.model-text wire:model="r3" tabindex="3" :label="'Resistance 3'"/>
                                <div>&nbsp;</div>
                                <x-input.model-text wire:model="s3" tabindex="7" :label="'Support 3'"/>
                            </div>
                        </x-tabs.content>

                    </x-slot>

                </x-tabs.tab-panel>

                <x-input.model-select wire:model="trend" :label="'Trend'">
                    <option value="">Choose...</option>
                    <option value="UpTrend">UpTrend</option>
                    <option value="DownTrend">DownTrend</option>
                    <option value="SideWise">SideWay</option>
                </x-input.model-select>

            </div>

        </x-forms.create>

    </x-forms.m-panel>
</div>

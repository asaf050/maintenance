@extends('maintenance::layouts.buttons.dropdown')

@section('dropdown.body.content')

    <li>
        <a
            href="{{ route('maintenance.api.inventory.stocks.edit', array($stock->item->id, $stock->id)) }}"
            class="update-stock">
            <i class="fa fa-refresh"></i> Update Stock
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="{{ route('maintenance.inventory.stocks.movements.index', array($stock->item->id, $stock->id)) }}">
            <i class="fa fa-search"></i> View Movements
        </a>
    </li>
    <li>
        <a
            href="{{ route('maintenance.inventory.stocks.destroy', array($stock->item->id, $stock->id)) }}"
            data-method="delete"
            data-message="Are you sure you want to delete this stock and all of it's movements?">
            <i class="fa fa-trash-o"></i> Delete Stock
        </a>
    </li>

@overwrite
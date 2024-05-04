<?php

function setActive($nameRoute){
    return request()->routeIs($nameRoute) ? 'active' : null;
}
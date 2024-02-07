<?php

namespace UnparseUrl\Enums;

enum Glues: string
{
    case SemiColon = ':';
    case Host = '//';
    case Authority = '@';
    case Query = '?';
    case Fragment = '#';
}

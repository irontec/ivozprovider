import React from 'react';

import Contains from './contains';
import StartsWith from './startsWith';
import EndsWith from './endsWith';
import Equals from './equals';
import NotEquals from './notEquals';
import LowerThan from './lowerThan';
import LowerThanEqual from './lowerThanEqual';
import GreaterThan from './greaterThan';
import GreaterThanEqual from './greaterThanEqual';
import NotInterestedIcon from '@mui/icons-material/NotInterested';
import AssignmentTurnedInIcon from '@mui/icons-material/AssignmentTurnedIn';

export default function FilterIconFactory(props: any = {}) {

    const { name, ...rest } = props;

    switch (name) {
        case '':
            return <NotInterestedIcon {...rest} />;
        case 'exists':
            return <AssignmentTurnedInIcon {...rest} />;
        case 'partial':
            return <Contains {...rest} />;
        case 'start':
            return <StartsWith {...rest} />;
        case 'end':
            return <EndsWith {...rest} />;
        case 'in':
        case 'exact':
        case 'eq':
            return <Equals {...rest} />;
        case 'neq':
            return <NotEquals {...rest} />;
        case 'lt':
            return <LowerThan {...rest} />;
        case 'lte':
            return <LowerThanEqual {...rest} />;
        case 'gt':
            return <GreaterThan {...rest} />;
        case 'gte':
            return <GreaterThanEqual {...rest} />;
        default:
            const error = { error: `Icon ${name} was not found` };
            throw error;
    }
}
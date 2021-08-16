import _ from 'services/Translations/translate';
import ArrowForwardIcon from '@material-ui/icons/ArrowForward';
import RotateLeftIcon from '@material-ui/icons/RotateLeft';
import { makeStyles, Tooltip } from '@material-ui/core';
import React from 'react';

interface StatusIconProps {
    directConnectivity: string,
    _context: string,
}

const StatusIcon = (props: StatusIconProps) => {

    const classes = statusStyles();
    const { directConnectivity, _context } = props;
    const writeContext = (_context === 'write');

    if (directConnectivity === 'yes') {

        if (writeContext) {
            return (
                <span>
                    <ArrowForwardIcon className={classes.green} />
                    {_('Direct connectivity')}
                </span>
            );
        }

        return (
            <Tooltip title={_('Direct connectivity')}>
                <ArrowForwardIcon className={classes.green} />
            </Tooltip>
        );
    }

    if (directConnectivity === 'intervpbx') {

        if (writeContext) {
            return (
                <span>
                    <RotateLeftIcon className={classes.green} />
                    {_('Inter company connectivity')}
                </span>
            );
        }

        return (
            <Tooltip title={_('Inter company connectivity')}>
                <RotateLeftIcon className={classes.green} />
            </Tooltip>
        );
    }

    //@TODO POSPONED else RegisterStatus::getLocationStatus
    return (<span />);
}


const statusStyles = makeStyles((theme: any) => ({
    green: {
      color: 'green',
      verticalAlign: 'bottom',
    },
}));

export default StatusIcon;
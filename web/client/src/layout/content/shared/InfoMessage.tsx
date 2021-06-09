
import React from 'react';
import InfoIcon from '@material-ui/icons/Info';
import { makeStyles, Theme } from '@material-ui/core/styles';
import Message from './Message';

export default function InfoMessage(props:any) {

    const { message } = props;
    const classes = useStyles();

    return (
        <Message
            message={message}
            contentStyles={classes.msg}
            Icon={InfoIcon}
        />
    );
}

const useStyles = makeStyles((theme: Theme) => ({
    msg: {
        backgroundColor: '#616161',
        color: 'white'
    }
}));


import React from 'react';
import ErrorIcon from '@material-ui/icons/Error';
import { makeStyles, Theme } from '@material-ui/core/styles';
import Message from './Message';

export default function ErrorMessage(props:any) {

    const { message } = props;
    const classes = useStyles();

    return (
        <Message
            message={message}
            contentStyles={classes.error}
            Icon={ErrorIcon}
        />
    );
}

const useStyles = makeStyles((theme: Theme) => ({
    error: {
        backgroundColor: theme.palette.error.dark,
        color: 'white'
    }
}));

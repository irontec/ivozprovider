import { makeStyles, Tooltip } from '@material-ui/core';
import _ from 'services/Translations/translate';

interface LastExecutionProps {
    lastExecution: string,
    lastExecutionError: string
}

const LastExecution = (props: LastExecutionProps) => {

    const classes = listDecoratorStyles();

    let { lastExecution, lastExecutionError } = props;
    lastExecution = lastExecution.replace('T', ' ');

    if (lastExecutionError) {
        return (
            <span>
                <Tooltip title={lastExecutionError}>
                    <span className={classes.error}>&#9888;</span>
                </Tooltip>
                {lastExecution}
            </span>
        );
    }

    return (
        <span>
            <Tooltip title={_('Successful execution')}>
                <span className={classes.success}>&#10004;</span>
            </Tooltip>
            {lastExecution}
        </span>
    );
}

const listDecoratorStyles = makeStyles((theme: any) => ({
    error: {
      color: 'red',
      fontWeight: 'bold',
      fontSize: '1.5em',
      lineHeight: '20px',
      verticalAlign: 'middle',
      paddingRight: '5px',
    },
    success: {
      color: 'green',
      fontWeight: 'bold',
      fontSize: '1.5em',
      lineHeight: '20px',
      verticalAlign: 'middle',
      paddingRight: '5px',
    },
}));

export default LastExecution;
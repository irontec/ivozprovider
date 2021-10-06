import { Tooltip } from '@mui/material';
import { PropertyCustomComponent, propertyCustomComponentProps } from 'lib/services/api/ParsedApiSpecInterface';
import _ from 'lib/services/translations/translate';
import { StyledLastExecutionErrorMsg, StyledLastExecutionSuccessMsg } from './LastExecution.styles';

type LastExecutionProps = propertyCustomComponentProps & {
    lastExecution: string,
    lastExecutionError: string
}

const LastExecution: PropertyCustomComponent<LastExecutionProps> = (props: LastExecutionProps) => {

    const lastExecution = props.lastExecution.replace('T', ' ');
    const { lastExecutionError } = props;

    if (lastExecutionError) {
        return (
            <span>
                <Tooltip title={lastExecutionError}>
                    <StyledLastExecutionErrorMsg>&#9888;</StyledLastExecutionErrorMsg>
                </Tooltip>
                {lastExecution}
            </span>
        );
    }

    return (
        <span>
            <Tooltip title={_('Successful execution')}>
                <StyledLastExecutionSuccessMsg>&#10004;</StyledLastExecutionSuccessMsg>
            </Tooltip>
            {lastExecution}
        </span>
    );
}

export default LastExecution;
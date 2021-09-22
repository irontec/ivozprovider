import { Tooltip } from '@mui/material';
import { PropertyCustomComponent, propertyCustomComponentProps } from 'services/Api/ParsedApiSpecInterface';
import _ from 'services/Translations/translate';
import { StyledLastExecutionErrorMsg, StyledLastExecutionSuccessMsg } from './LastExecution.styles';

type LastExecutionProps = propertyCustomComponentProps & {
    lastExecution: string,
    lastExecutionError: string
}

const LastExecution: PropertyCustomComponent<LastExecutionProps> = (props: LastExecutionProps) => {

    let { lastExecution, lastExecutionError } = props;
    lastExecution = lastExecution.replace('T', ' ');

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
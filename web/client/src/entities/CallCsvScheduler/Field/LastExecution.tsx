import { Tooltip } from '@mui/material';
import _ from 'lib/services/translations/translate';
import { StyledLastExecutionErrorMsg, StyledLastExecutionSuccessMsg } from './LastExecution.styles';
import { CallCsvSchedulerPropertyList } from '../CallCsvSchedulerProperties';
import withCustomComponentWrapper, { PropertyCustomFunctionComponent, PropertyCustomFunctionComponentProps } from 'lib/services/form/Field/CustomComponentWrapper';

type CallCsvSchedulerValues = CallCsvSchedulerPropertyList<string | number>;
type LastExecutionType = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<CallCsvSchedulerValues>>;

const LastExecution: LastExecutionType = (props) => {

    const values = props.values;
    const lastExecution = ((values?.lastExecution as string | undefined) || '').replace('T', ' ');
    const lastExecutionError = values?.lastExecutionError as string | undefined;

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

export default withCustomComponentWrapper<CallCsvSchedulerValues>(LastExecution);
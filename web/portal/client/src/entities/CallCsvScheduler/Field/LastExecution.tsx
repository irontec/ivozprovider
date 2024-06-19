import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { Tooltip } from '@mui/material';

import { CallCsvSchedulerPropertyList } from '../CallCsvSchedulerProperties';
import {
  StyledLastExecutionErrorMsg,
  StyledLastExecutionSuccessMsg,
} from './LastExecution.styles';

type CallCsvSchedulerValues = CallCsvSchedulerPropertyList<string | number>;
type LastExecutionType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<CallCsvSchedulerValues>
>;

const LastExecution: LastExecutionType = (props) => {
  const values = props.values;
  const lastExecution = (
    (values?.lastExecution as string | undefined) || ''
  ).replace('T', ' ');
  const lastExecutionError = values?.lastExecutionError as string | undefined;

  if (lastExecutionError) {
    return (
      <span>
        <Tooltip title={lastExecutionError} enterTouchDelay={0}>
          <StyledLastExecutionErrorMsg>&#9888;</StyledLastExecutionErrorMsg>
        </Tooltip>
        {lastExecution}
      </span>
    );
  }

  return (
    <span>
      <Tooltip title={_('Successful execution')} enterTouchDelay={0}>
        <StyledLastExecutionSuccessMsg>&#10004;</StyledLastExecutionSuccessMsg>
      </Tooltip>
      {lastExecution}
    </span>
  );
};

export default withCustomComponentWrapper<CallCsvSchedulerValues>(
  LastExecution
);

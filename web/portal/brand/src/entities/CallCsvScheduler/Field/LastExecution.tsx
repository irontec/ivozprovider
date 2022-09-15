import { styled } from '@mui/styles';
import { Tooltip } from '@mui/material';
import DoneIcon from '@mui/icons-material/Done';
import CloseIcon from '@mui/icons-material/Close';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { CallCsvSchedulerPropertyList } from '../CallCsvSchedulerProperties';

type ScalarRowTypes = CallCsvSchedulerPropertyList<string | boolean>;
type LastExecutionValues =
  ScalarRowTypes /* & { status: Array<CallCsvSchedulerStatus> }*/;
type LastExecutionProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<ScalarRowTypes, LastExecutionValues>
>;

const LastExecution: LastExecutionProps = (props): JSX.Element | null => {
  const { _context, values } = props;

  if (_context !== 'read') {
    return null;
  }

  if (!values || !values.lastExecution) {
    return null;
  }

  const iconStyles = { verticalAlign: 'bottom' };

  if (values.lastExecutionError === '') {
    const StyledIcon = styled(DoneIcon)(() => {
      return {
        ...iconStyles,
        color: 'green',
      };
    });
    return (
      <>
        {values.lastExecution}
        <Tooltip title={_('Successful execution')} enterTouchDelay={0}>
          <StyledIcon />
        </Tooltip>
      </>
    );
  }

  const StyledIcon = styled(CloseIcon)(() => iconStyles);
  return (
    <>
      {values.lastExecution}
      <Tooltip title={values.lastExecutionError as string} enterTouchDelay={0}>
        <StyledIcon />
      </Tooltip>
    </>
  );
};

export default LastExecution;

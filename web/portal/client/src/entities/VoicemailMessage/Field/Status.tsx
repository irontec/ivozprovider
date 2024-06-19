import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import DraftsIcon from '@mui/icons-material/Drafts';
import EmailIcon from '@mui/icons-material/Email';
import { Tooltip } from '@mui/material';

import { VoicemailMessagePropertyList } from '../VoicemailMessageProperties';

type VoicemailMessageValues = VoicemailMessagePropertyList<
  string | number | boolean
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<VoicemailMessageValues>
>;

const Status: TargetGhostType = (props): JSX.Element => {
  const { values } = props;
  const { folder } = values;

  if (folder === 'INBOX') {
    return (
      <Tooltip title={folder}>
        <EmailIcon />
      </Tooltip>
    );
  }

  return (
    <Tooltip title={folder as string}>
      <DraftsIcon />
    </Tooltip>
  );
};

export default withCustomComponentWrapper<VoicemailMessageValues>(Status);

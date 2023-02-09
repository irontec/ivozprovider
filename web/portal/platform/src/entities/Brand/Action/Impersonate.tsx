import OpenInNewIcon from '@mui/icons-material/OpenInNew';
import { Tooltip } from '@mui/material';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';
import {
  ActionFunctionComponent,
  ActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';

const Impersonate: ActionFunctionComponent = (props: ActionItemProps) => {
  const { row } = props;
  const token = useStoreState((state) => state.auth.token);

  if (!row) {
    return null;
  }

  const { id } = row;
  const queryString = `target=${id}&token=${token}`;

  return (
    <a href={`/client/?${queryString}`} target="_impersonate-client">
      <Tooltip
        title={_('Impersonate as brand admin')}
        placement="bottom-start"
        enterTouchDelay={0}
      >
        <OpenInNewIcon />
      </Tooltip>
    </a>
  );
};

export default Impersonate;

import { MoreMenuItem } from '@irontec/ivoz-ui/components/List/Content/Shared/MoreChildEntityLinks';
import { StyledTableRowCustomCta } from '@irontec/ivoz-ui/components/List/Content/Table/ContentTable.styles';
import {
  ActionFunctionComponent,
  isSingleRowAction,
  MultiSelectActionItemProps,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import AddCircleIcon from '@mui/icons-material/AddCircle';
import { Tooltip } from '@mui/material';
import { Link } from 'react-router-dom';

const AddHolidayDateRange: ActionFunctionComponent = (
  props: MultiSelectActionItemProps
) => {
  const { variant = 'icon' } = props;

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const targetUrl = location.pathname.replace(
    '/holiday_dates',
    '/holiday_dates_range'
  );

  const linkStyles = {
    textDecoration: 'none',
    color: 'inherit',
  };

  return (
    <>
      <Link to={targetUrl} style={linkStyles}>
        {variant === 'text' && (
          <MoreMenuItem>{_('Add Holiday date range')}</MoreMenuItem>
        )}
        {variant === 'icon' && (
          <Tooltip
            title={_('Add Holiday date range')}
            placement='bottom'
            enterTouchDelay={0}
          >
            <span>
              <StyledTableRowCustomCta>
                <AddCircleIcon />
              </StyledTableRowCustomCta>
            </span>
          </Tooltip>
        )}
      </Link>
    </>
  );
};

export default AddHolidayDateRange;

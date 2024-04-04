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
import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { useStoreState } from 'store';

const AddHolidayDateRange: ActionFunctionComponent = (
  props: MultiSelectActionItemProps
) => {
  const { variant = 'icon' } = props;
  const [disabled, setDisabled] = useState(false);
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const holidayDateRangeAcl = aboutMe?.acls?.find(
    (item) => item.iden === 'HolidayDateRange'
  );

  useEffect(() => {
    if (aboutMe?.restricted === true && holidayDateRangeAcl?.create !== true) {
      setDisabled(true);
    }
  }, [aboutMe, holidayDateRangeAcl?.create]);

  if (isSingleRowAction(props)) {
    return <span className='display-none'></span>;
  }

  const targetUrl = location.pathname.replace(
    '/holiday_dates',
    '/holiday_dates_range'
  );

  const linkStyles: React.CSSProperties = {
    textDecoration: 'none',
    color: 'inherit',
  };

  return (
    <>
      <Link
        to={targetUrl}
        style={linkStyles}
        onClick={(e) => {
          if (!disabled) {
            return;
          }

          e.preventDefault();
          e.stopPropagation();
        }}
      >
        {variant === 'text' && (
          <MoreMenuItem className={disabled ? 'disabled' : ''}>
            {_('Add Holiday date range')}
          </MoreMenuItem>
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

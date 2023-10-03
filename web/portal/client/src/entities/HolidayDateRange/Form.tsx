import { EntityValues } from '@irontec/ivoz-ui';
import { getMarshallerWhiteList } from '@irontec/ivoz-ui/components/form.helper';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import useCancelToken from '@irontec/ivoz-ui/hooks/useCancelToken';
import { useNavigate } from 'react-router-dom';

import { useStoreActions } from '../../store';
import { foreignKeyGetter } from './ForeignKeyGetter';
import HolidayDateRange from './HolidayDateRange';

const Form = (props: EntityFormProps): JSX.Element => {
  const {
    entityService,
    row,
    match,
    marshaller,
    filterBy,
    fixedValues,
    filterValues,
  } = props;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name', 'locution'],
    },
    {
      legend: '',
      fields: ['startDate', 'endDate', 'wholeDayEvent', 'timeIn', 'timeOut'],
    },
    {
      legend: '',
      fields: [
        'routeType',
        'extension',
        'voicemail',
        'numberCountry',
        'numberValue',
        'calendar',
      ],
    },
  ];

  const navigate = useNavigate();
  const apiPost = useStoreActions((actions) => actions.api.post);
  const [, cancelToken] = useCancelToken();

  const onSubmit = async (values: EntityValues) => {
    const whitelist = getMarshallerWhiteList({
      filterBy,
      fixedValues,
      filterValues,
    });
    const payload = marshaller(
      values,
      entityService.getAllProperties(),
      whitelist
    );
    const formData = entityService.prepareFormData(payload);

    try {
      const resp = await apiPost({
        path: HolidayDateRange.path,
        values: formData,
        contentType: 'application/json',
        cancelToken,
      });

      if (resp !== undefined) {
        const redirectPath = match.pathname.replace(
          HolidayDateRange.path,
          '/holiday_dates'
        );

        navigate(redirectPath, {
          state: {
            referrer: location.pathname,
          },
        });
      } else {
        // eslint-disable-next-line no-console
        console.info('Unexpected form response');
      }
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <DefaultEntityForm
      {...props}
      fkChoices={fkChoices}
      groups={groups}
      filterBy='calendar'
      onSubmit={onSubmit}
    />
  );
};

export default Form;

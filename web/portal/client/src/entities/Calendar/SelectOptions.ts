import { DropdownChoices } from '@irontec-voip/ivoz-ui';
import defaultEntityBehavior from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec-voip/ivoz-ui/entities/EntityInterface';
import store from 'store';

const CalendarSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Calendar = entities.Calendar;

  return defaultEntityBehavior.fetchFks(
    Calendar.path,
    ['id', 'name'],
    (data) => {
      const options: DropdownChoices = {};
      for (const item of data) {
        options[item.id] = item.name;
      }

      callback(options);
    },
    cancelToken
  );
};

export default CalendarSelectOptions;

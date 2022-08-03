import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import store from 'store';

const CalendarPeriodsRelScheduleSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const CalendarPeriodsRelSchedule = entities.CalendarPeriodsRelSchedule;
  const Schedule = entities.Schedule;

  return defaultEntityBehavior.fetchFks(
    CalendarPeriodsRelSchedule.path,
    ['id', 'schedule'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = Schedule.toStr(item.schedule);
      }

      callback(options);
    },
    cancelToken
  );
};

export default CalendarPeriodsRelScheduleSelectOptions;

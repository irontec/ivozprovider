import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import ConferenceRoom from './ConferenceRoom';

const ConferenceRoomSelectOptions: SelectOptionsType = ({ callback, cancelToken }): Promise<unknown> => {

  return defaultEntityBehavior.fetchFks(
    ConferenceRoom.path,
    ['id', 'name'],
    (data: any) => {
      const options: any = {};
      for (const item of data) {
        options[item.id] = item.name;
      }

      callback(options);
    },
    cancelToken,
  );
};

export default ConferenceRoomSelectOptions;
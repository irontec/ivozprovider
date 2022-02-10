import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import IvrEntry from './IvrEntry';

//const IvrEntrySelectOptions = (callback: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {
//
//    return defaultEntityBehavior.fetchFks(
//        IvrEntry.path,
//        ['id', 'name'],
//        (data: any) => {
//            const options: any = {};
//            for (const item of data) {
//                options[item.id] = item.id;
//            }
//
//            callback(options);
//        },
//        cancelToken
//    );
//}
//
//export default IvrEntrySelectOptions;
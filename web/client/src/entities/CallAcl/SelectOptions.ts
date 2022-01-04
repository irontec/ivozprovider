import { CancelToken } from 'axios';
import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import CallAcl from './CallAcl';

const CallAclSelectOptions = (callback: FetchFksCallback, cancelToken?: CancelToken): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        CallAcl.path,
        ['id', 'name'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        },
        cancelToken
    );
}

export default CallAclSelectOptions;
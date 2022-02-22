import TerminalModelSelectOptions from '../TerminalModel/SelectOptions';
import { TerminalPropertyList } from './TerminalProperties';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async ({cancelToken}): Promise<any> => {

    const response: TerminalPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = TerminalModelSelectOptions({
        callback: (options: any) => {
            response.terminalModel = options;
        },
        cancelToken
    });

    await Promise.all(promises);

    return response;
};
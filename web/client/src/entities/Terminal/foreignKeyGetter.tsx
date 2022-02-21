import TerminalModelSelectOptions from '../TerminalModel/SelectOptions';
import { TerminalPropertyList } from './TerminalProperties';
import { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: TerminalPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = TerminalModelSelectOptions(
        (options: any) => {
            response.terminalModel = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};
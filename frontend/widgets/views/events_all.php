<table>
                            <tr>
                                <th>Актив</th>
                                <th>Наименование события</th>
                                <th>Дата (Мск. время)</th>
                                <th>Описание события</th>
                            </tr>
                            <?foreach ($items as $item) {?>
                            <tr>
                                <td class="center"><?=$item->eventactive?></td>
                                <td class="center"><?=$item->name?></td>
                                <td><?=date('d.m.Y',$item->eventdate)?> <span style="text-decoration: underline;"><?=$item->eventtime?></span></td>
                                <td><?=$item->description?></td>
                            </tr> 
                            <?}?>                             
</table>
